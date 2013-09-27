<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title ?> - Harambee! Crowd-sourced funding for grass-roots projects.</title>
<meta content="<?php echo $description ?>" name="description" />
<meta content="<?php echo $keywords ?>" name="keywords" />
<link href="/css/index.css" rel="stylesheet" type="text/css" />
<?php 
if (isset($style)) 
{
	echo '<style type="text/css"><!--';
	foreach ($style as $selector => $formatting)
	{
		echo $selector.' {'.$formatting.'}'."\n";
	}
	echo "--></style>\n";
} 
?>
</head>
