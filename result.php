
<?php
mysql_connect("localhost", "youthcyb_160s1g3", "group3_database");
mysql_select_db("youthcyb_160s1g3");
function truncate_chars($text, $size) {
    if( strlen($text) > $size ) {
        $endpos = strpos(str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $text), ' ', $size);
        if($endpos !== FALSE)
            $text = trim(substr($text, 0, $endpos)) . "...";
    }
    return $text;
}

if (isset($_GET["Search"])) {
    $ignore = array("a", "an", "the", "of", "for", "and", "or", "by", "in", "on", "with", "to");
	$string = strtolower($_GET["Search"]);
	$input = preg_replace("/\ba\b/", '', $string);
	$terms = preg_split("/[\W]+/", $input, -1, PREG_SPLIT_NO_EMPTY);
	$query_s = "SELECT * FROM education WHERE";
	
	if (empty($terms)) $terms[0] = '';
	foreach ($terms as $term) {
		$query_s = $query_s . " description LIKE '% " . $term . "%' 
		OR description LIKE '" . $term . "%'
		OR title LIKE '% " . $term . "%' 
		OR title LIKE '" . $term . "%'
		OR category LIKE '% " . $term . "%'
		OR category LIKE '" . $term . "%'
		OR author LIKE '% " . $term . "%' 
		OR author LIKE '" . $term . "%'
		OR student_grades LIKE '% " . $term . "'       
		OR content_type LIKE '% " . $term . "%' 
		OR content_type LIKE '" . $term . "%'
		OR lesson_link LIKE '% " . $term . "%'
		OR lesson_link LIKE '" . $term . "%'
		OR";
	}
	
	$query_s = $query_s . "DER BY title";
	
	$query = mysql_query($query_s);
}
else if(isset($_GET['category']))
    $query = mysql_query("SELECT * FROM education WHERE category LIKE '".$_GET['category']."%'");
else if(isset($_GET['grade']))
    $query = mysql_query("SELECT * FROM education 
        WHERE student_grades LIKE '%,".$_GET['grade']."'
        OR student_grades LIKE '".$_GET['grade']."'
        OR student_grades LIKE '%,".$_GET['grade'].",%'
        OR student_grades LIKE '".$_GET['grade'].",%'");
else
    $query = mysql_query("SELECT * FROM education");
?>

<html>
<head>
<title>Search Results </title>

</head>
<body bgcolor="7FFFD4">
  <a href="index.php" target="_parent"><button>GO BACK TO HOMEPAGE</button></a>
<h1>Search Results </h1>
  <table border="1" cellpadding = "2" cellspaceing = "3" summary="Table holds the interactive lessons">
	<tbody>
    <tr>
    <th bgcolor="#0099FF" >Title</th>
    <th bgcolor="#0099FF">Description</th>        
    <th bgcolor="#0099FF">Lesson_image</th>
    <th bgcolor="#0099FF">Category</th>
    <th bgcolor="#0099FF">Student_grades</th>
    <th bgcolor="#0099FF">Author</th>
    <th bgcolor="#0099FF">Content_type</th>
   </tr>

<?php
//loop through all table rows
while($row = mysql_fetch_array($query)){
echo "<tr>";
echo "<td ><a href={$row['lesson_link']}>" . truncate_chars($row['title'],100) . "</a></td>";
echo "<td >" . truncate_chars($row['description'],200) . "</td>";
echo "<td ><img src={$row['lesson_image']}> </td>" ;
echo "<td >" . $row['category'] . "</td>";
echo "<td >" . $row['student_grades'] . "</td>";
echo "<td >" . $row['author'] . "</td>";
echo "<td >" . $row['content_type'] . "</td>";
}
mysql_free_result($query);
mysql_close();
?>
</tbody>
</table>
  <a href="index.php" target="_parent"><button>GO BACK TO HOMEPAGE</button></a>

</body>
</html>
