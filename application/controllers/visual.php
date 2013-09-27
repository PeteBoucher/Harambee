<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visual extends CI_Controller {

	/**
	 * Function generates a PNG format image visualising the progress o a given goal or project.
	 *
	 *
	 * @var string $type 'goal' or 'proj'
	 * @var int $id Goal or Project identifier
	 * @var char $orientation 'h' or 'v'
	 *
	 */
	public function totalizer($type, $id, $orientation='h', $width='300')
	{
		
		header('Content-Type: image/png');
		$completion = 0;
		
		// Set the enviroment variable for GD
		putenv('GDFONTPATH=' . realpath('./system/fonts/'));
		$font = 'texb';
		
		//BORDER WIDTH IN PIXELS
		define('BORDER', 10);
		define('FONT', 2);
		define('KERNING', 7);
		
		if ($type == 'goal') //we're dealing with a single goal
		{
			/* Moved the following code block to a function _completion()
			//total amount raised on this gaol
			$sqlGoalSum = 'SELECT SUM( Amount ) 
				AS Total
				FROM  `Donation` 
				WHERE GoalID = ?';
			$goalSum = $this->db->query($sqlGoalSum, array($id));
			
			$row = $goalSum->row();
			$amountRaised = $row->Total;
			//$amountRaised = 30;
			
			//goal amount to be raised
			$this->db->select('GoalAmount');
			$this->db->where('GoalID', $id);
			$goalAmt = $this->db->get('Goal');
			
			$row = $goalAmt->row();
			$goalAmount = $row->GoalAmount;
			//$goalAmount = 210;
			
			$completion = $amountRaised/$goalAmount; */
			
			$completion = $this->_completion($id);
		}
		else //we're dealing with a project so lets get the mean completion of all it's goals
		{
			//Retrieve list of goals for this project
			$this->db->select('GoalID');
			$this->db->from('Goal');
			$this->db->where(array('ProjectID' => $id));
			$goals = $this->db->get();
			
			//Populate 'goal' array for view
			$projCompletion = array();
			foreach ($goals->result() as $row)
			{
				$projCompletion[$row->GoalID] = $this->_completion($row->GoalID);
			}
			//project total
			$countGoals = count($projCompletion); 
            $sumGoals = array_sum($projCompletion); 
            //THERES SOMETHING WRONG HERE: $completion = 
			/* $compString = $countGoals; // 
			$compString .= ','.number_format($sumGoals,2); */
			$completion = $sumGoals/$countGoals;
			$completion = number_format($completion,2);
			
		}
		
		if ($orientation == 'h') //horizontal totaliser
		{
			$imgW = $width;
			$imgH = '30';
			$totX = BORDER + ( $imgW - ( BORDER * 2 ) )  * $completion;
			$totY = $imgH-BORDER;
		}
		else //vertical style totaliser
		{
			$imgW = '185';
			$imgH = '300';
			$totX = BORDER;
			$totY = ( $imgH - BORDER ) - ( ( $imgH - ( BORDER * 2 ) ) * $completion );
		}
		
		//create image and fill
		$totaliser = imagecreatetruecolor($imgW, $imgH);
		// Fill the image with transparent color 
		/* imagesavealpha($totaliser, true);
		$color = imagecolorallocatealpha($img,0x00,0x00,0x00,127); 
		imagefill($img, 0, 0, $color);  */
		//fill the image with white
		$colorBG = imagecolorallocate($totaliser, 255, 255, 255);
		imagefilledrectangle($totaliser, 0,0, $imgW, $imgH, $colorBG);
		
		//Create progress percentage string
		$compString = round($completion*100, 'PHP_ROUND_HALF_DOWN');
		$compString .= '%';
		$len = strlen($compString);
		$charPosX = $totX;
		
		//draw progress bar					 
		$colorIndicator = imagecolorallocate($totaliser, 255, 0, 0);
		$colorIndicatorBG = imagecolorallocate($totaliser, 255, 227, 227);
		if ($orientation == 'h') //horizontal totaliser
		{
			imagefilledrectangle($totaliser, BORDER, BORDER, $imgW-BORDER, $imgH-BORDER, $colorIndicatorBG); //Background
			imagefilledrectangle($totaliser, BORDER, BORDER, $totX, $totY, $colorIndicator); //Progress indicator
			
			//write percentage
			if ($charPosX+($len*KERNING) > $imgW) //text will run off edge of image
			{
				$charPosX = $charPosX - BORDER;
				$charPosX = $charPosX - ( $len * KERNING );
				$colorText = imagecolorallocate($totaliser, 255, 255, 255);
			}
			else
			{
				$colorText = $colorIndicator;
			}
			//write the characters
			for ($i=0; $i<$len; $i++)
			{
				$charPosX = $charPosX + KERNING;
				imagechar($totaliser, FONT, $charPosX, BORDER-1, $compString, $colorText);
				$compString = substr($compString,1);
			}
			/* imagettftext($totaliser, 2, 0, $totX+BORDER, BORDER, $colorIndicator, $font, $compString); */
		}
		else //vertical style totaliser
		{
			imagefilledrectangle($totaliser, BORDER, BORDER, BORDER+BORDER, $imgH-BORDER, $colorIndicatorBG); //Background
			imagefilledrectangle($totaliser, BORDER, $imgH-BORDER, BORDER+BORDER, $totY, $colorIndicator); //Progress indicator
			
			//write percentage
			if ($totY-BORDER-KERNING < 0) //text will dissapear off top of image
			{
				$charPosY = $totY;
				$charPosX = $totX + BORDER + 3;
			}
			else
			{
				$charPosY = $totY-BORDER-KERNING;
			}
			//write the characters
			for ($i=0; $i<$len; $i++)
			{
				imagechar($totaliser, FONT, $charPosX, $charPosY, $compString, $colorIndicator);
				$compString = substr($compString,1);
				$charPosX = $charPosX + KERNING;
			}
		}
		
		//output image
		imagepng($totaliser, NULL, 0);
		
		imagedestroy($totaliser);
	}
	
	/**
	 * Utility function calculates the totalDonations/goalAmount ratio for a given Goal
	 *
	 * @var int $goalID Goal identifier
	 * @return float between 0.0 and 1.0
	 */
	function _completion($goalID)
	{
		//total amount raised on this gaol
		$sqlGoalSum = 'SELECT SUM( Amount ) 
			AS Total
			FROM  `Donation` 
			WHERE GoalID = ?';
		$goalSum = $this->db->query($sqlGoalSum, array($goalID));
		
		$row = $goalSum->row();
		$amountRaised = $row->Total;
		
		//goal amount to be raised
		$this->db->select('GoalAmount');
		$this->db->where('GoalID', $goalID);
		$goalAmt = $this->db->get('Goal');
		
		$row = $goalAmt->row();
		$goalAmount = $row->GoalAmount;
		
		$result = $amountRaised/$goalAmount;
		return( $result );
	}
	
}

/* End of file org.php */
/* Location: ./application/controllers/org.php */

?>
