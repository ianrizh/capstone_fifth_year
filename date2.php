<?php 
Class Database{
 
	private $server = "mysql:host=localhost;dbname=capstone_fifth_year";
	private $username = "root";
	private $password = "";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;
 	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "There is some problem in connection: " . $e->getMessage();
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}

$pdo = new Database();
$conn = $pdo->open();
$output='';

if(isset($_POST["date"]))
{
if($_POST["date"] != '')

{

}
else
{

}
$id_services=$_POST['date2'];
$date= $_POST["date"];
$theday=date('l',strtotime($date));
if($theday == 'Sunday')
{
	
echo '
<div id="time" class="form-group">
<label for="edit_name" class="col-sm-3 control-label">Time</label>
<div class="col-sm-9">
<select class="form-control" id="time" name="time_reservation" required>
<option value="" disabled selected required>---Select---</option>';
$stmt = $conn->prepare("select * from type where type = 'Services'");
$stmt->execute();
foreach($stmt as $r){
$id_type = $r['id_type'];
$stmt = $conn->prepare("select * from schedule where id_type = '$id_type' and day = 'Sunday'");
$stmt->execute();
foreach($stmt as $ro){
$schedule_id = $ro['schedule_id'];
$stmt=$conn->prepare("select * from doctor where date ='$date' and in_charge = 0 and status = 'Not Available'");
$stmt->execute();
foreach($stmt as $gro);
$grooming_date=$gro['time_id'];	
$stmt = $conn->prepare("select * from time where schedule_id='$schedule_id'  and time_id != '$grooming_date'");
$stmt->execute();
foreach($stmt as $row){
$time_id = $row['time_id'];
$time = $row['time_reservation'];
$stmt = $conn->prepare("select *, Count(*)as numrows from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $sss);
$numrows=$sss['numrows'];
$stmt = $conn->prepare("select * from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $rows1);
 $time1 = $rows1['time_reservation'];
$date2 = $rows1['thedate'];
$stmt = $conn->prepare("select * from doctor where time_id = '$time_id' and status ='Not Available' or time_id=0 and status ='Not Available'");
$stmt->execute();
foreach($stmt as $rows);
$doctor_id = $rows['doctor_id'];
$time_id1 = $rows['time_id'];
$date1 = $rows['date'];
$incharge=$rows['in_charge'];
$status = $rows['status'];
if($grooming_date == ""){

	$as=$numrows+$incharge;	
if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';
}
}
else if($grooming_date == 0)
{}
else{

	if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';	
}
}
}
}
}

echo'
</select>
</div>
</div>
';
}	
elseif($theday == 'Monday')
{
echo '
<div id="time" class="form-group">
<label for="edit_name" class="col-sm-3 control-label">Time</label>
<div class="col-sm-9">
<select class="form-control" id="time" name="time_reservation" required>
<option value="" disabled selected required>---Select---</option>';
$stmt = $conn->prepare("select * from type where type = 'Services'");
$stmt->execute();
foreach($stmt as $r){
$id_type = $r['id_type'];
$stmt = $conn->prepare("select * from schedule where id_type = '$id_type' and day = 'Monday'");
$stmt->execute();
foreach($stmt as $ro){
$schedule_id = $ro['schedule_id'];
$stmt=$conn->prepare("select * from doctor where date ='$date' and in_charge = 0 and status = 'Not Available'");
$stmt->execute();
foreach($stmt as $gro);
$grooming_date=$gro['time_id'];	
$stmt = $conn->prepare("select * from time where schedule_id='$schedule_id'  and time_id != '$grooming_date'");
$stmt->execute();
foreach($stmt as $row){
$time_id = $row['time_id'];
$time = $row['time_reservation'];
$stmt = $conn->prepare("select *, Count(*)as numrows from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $sss);
$numrows=$sss['numrows'];
$stmt = $conn->prepare("select * from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $rows1);
 $time1 = $rows1['time_reservation'];
$date2 = $rows1['thedate'];
$stmt = $conn->prepare("select * from doctor where time_id = '$time_id' and status ='Not Available' or time_id = 0 and status ='Not Available'");
$stmt->execute();
foreach($stmt as $rows);
$doctor_id = $rows['doctor_id'];
$time_id1 = $rows['time_id'];
$date1 = $rows['date'];
$incharge=$rows['in_charge'];
$status = $rows['status'];

if($grooming_date == ""){

	$as=$numrows+$incharge;	
if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';
}
}
else if($grooming_date == 0)
{}
else{

	if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';	
}
}
}
}
}
echo'
</select>
</div>
</div>
';
}
elseif($theday == 'Tuesday')
{
echo '
<div id="time" class="form-group">
<label for="edit_name" class="col-sm-3 control-label">Time</label>
<div class="col-sm-9">
<select class="form-control" id="time" name="time_reservation" required>
<option value="" disabled selected required>---Select---</option>';
$stmt = $conn->prepare("select * from type where type = 'Services'");
$stmt->execute();
foreach($stmt as $r){
$id_type = $r['id_type'];
$stmt = $conn->prepare("select * from schedule where id_type = '$id_type' and day = 'Tuesday'");
$stmt->execute();
foreach($stmt as $ro){
$schedule_id = $ro['schedule_id'];
$stmt=$conn->prepare("select * from doctor where date ='$date' and in_charge = 0 and status = 'Not Available'");
$stmt->execute();
foreach($stmt as $gro);
$grooming_date=$gro['time_id'];	
$stmt = $conn->prepare("select * from time where schedule_id='$schedule_id'  and time_id != '$grooming_date'");
$stmt->execute();
foreach($stmt as $row){
$time_id = $row['time_id'];
$time = $row['time_reservation'];
$stmt = $conn->prepare("select *, Count(*)as numrows from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $sss);
$numrows=$sss['numrows'];
$stmt = $conn->prepare("select * from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $rows1);
 $time1 = $rows1['time_reservation'];
$date2 = $rows1['thedate'];
$stmt = $conn->prepare("select * from doctor where time_id = '$time_id' and status ='Not Available' or time_id=0 and status ='Not Available'");
$stmt->execute();
foreach($stmt as $rows);
$doctor_id = $rows['doctor_id'];
$time_id1 = $rows['time_id'];
$date1 = $rows['date'];
$incharge=$rows['in_charge'];
$status = $rows['status'];

if($grooming_date == ""){

	$as=$numrows+$incharge;	
if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';
}
}
else if($grooming_date == 0)
{}
else{

	if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';	
}
}
}
}
}
echo'
</select>
</div>
</div>
';
}
elseif($theday == 'Wednesday')
{
echo '
<div id="time" class="form-group">
<label for="edit_name" class="col-sm-3 control-label">Time</label>
<div class="col-sm-9">
<select class="form-control" id="time" name="time_reservation" required>
<option value="" disabled selected required>---Select---</option>';
$stmt = $conn->prepare("select * from type where type = 'Services'");
$stmt->execute();
foreach($stmt as $r){
$id_type = $r['id_type'];
$stmt = $conn->prepare("select * from schedule where id_type = '$id_type' and day = 'Wednesday'");
$stmt->execute();
foreach($stmt as $ro){
$schedule_id = $ro['schedule_id'];
$stmt=$conn->prepare("select * from doctor where date ='$date' and in_charge = 0 and status = 'Not Available'");
$stmt->execute();
foreach($stmt as $gro);
$grooming_date=$gro['time_id'];	
$stmt = $conn->prepare("select * from time where schedule_id='$schedule_id'  and time_id != '$grooming_date'");
$stmt->execute();
foreach($stmt as $row){
$time_id = $row['time_id'];
$time = $row['time_reservation'];
$stmt = $conn->prepare("select *, Count(*)as numrows from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $sss);
$numrows=$sss['numrows'];
$stmt = $conn->prepare("select * from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $rows1);
 $time1 = $rows1['time_reservation'];
$date2 = $rows1['thedate'];
$stmt = $conn->prepare("select * from doctor where time_id = '$time_id' and status ='Not Available' or time_id=0 and status ='Not Available'");
$stmt->execute();
foreach($stmt as $rows);
$doctor_id = $rows['doctor_id'];
$time_id1 = $rows['time_id'];
$date1 = $rows['date'];
$incharge=$rows['in_charge'];
$status = $rows['status'];

if($grooming_date == ""){

	$as=$numrows+$incharge;	
if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';
}
}
else if($grooming_date == 0)
{}
else{

	if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';	
}
}
}
}
}
echo'
</select>
</div>
</div>
';
}
elseif($theday == 'Thursday')
{
echo '
<div id="time" class="form-group">
<label for="edit_name" class="col-sm-3 control-label">Time</label>
<div class="col-sm-9">
<select class="form-control" id="time" name="time_reservation" required>
<option value="" disabled selected required>---Select---</option>';
$stmt = $conn->prepare("select * from type where type = 'Services'");
$stmt->execute();
foreach($stmt as $r){
$id_type = $r['id_type'];
$stmt = $conn->prepare("select * from schedule where id_type = '$id_type' and day = 'Thursday'");
$stmt->execute();
foreach($stmt as $ro){
$schedule_id = $ro['schedule_id'];
$stmt=$conn->prepare("select * from doctor where date ='$date' and in_charge = 0 and status = 'Not Available'");
$stmt->execute();
foreach($stmt as $gro);
$grooming_date=$gro['time_id'];	
$stmt = $conn->prepare("select * from time where schedule_id='$schedule_id'  and time_id != '$grooming_date'");
$stmt->execute();
foreach($stmt as $row){
$time_id = $row['time_id'];
$time = $row['time_reservation'];
$stmt = $conn->prepare("select *, Count(*)as numrows from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $sss);
$numrows=$sss['numrows'];
$stmt = $conn->prepare("select * from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $rows1);
 $time1 = $rows1['time_reservation'];
$date2 = $rows1['thedate'];
$stmt = $conn->prepare("select * from doctor where time_id = '$time_id' and status ='Not Available'  or time_id=0 and status ='Not Available'");
$stmt->execute();
foreach($stmt as $rows);
$doctor_id = $rows['doctor_id'];
$time_id1 = $rows['time_id'];
$date1 = $rows['date'];
$incharge=$rows['in_charge'];
$status = $rows['status'];

if($grooming_date == ""){

	$as=$numrows+$incharge;	
if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';
}
}
else if($grooming_date == 0)
{}
else{

	if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';	
}
}
}
}
}
echo'
</select>
</div>
</div>
';
}
elseif($theday == 'Friday')
{
echo '
<div id="time" class="form-group">
<label for="edit_name" class="col-sm-3 control-label">Time</label>
<div class="col-sm-9">
<select class="form-control" id="time" name="time_reservation" required>
<option value="" disabled selected required>---Select---</option>';
$stmt = $conn->prepare("select * from type where type = 'Services'");
$stmt->execute();
foreach($stmt as $r){
$id_type = $r['id_type'];
$stmt = $conn->prepare("select * from schedule where id_type = '$id_type' and day = 'Friday'");
$stmt->execute();
foreach($stmt as $ro){
$schedule_id = $ro['schedule_id'];
$stmt=$conn->prepare("select * from doctor where date ='$date' and in_charge = 0 and status = 'Not Available'");
$stmt->execute();
foreach($stmt as $gro);
$grooming_date=$gro['time_id'];	
$stmt = $conn->prepare("select * from time where schedule_id='$schedule_id'  and time_id != '$grooming_date'");
$stmt->execute();
foreach($stmt as $row){
$time_id = $row['time_id'];
$time = $row['time_reservation'];
$stmt = $conn->prepare("select *, Count(*)as numrows from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $sss);
$numrows=$sss['numrows'];
$stmt = $conn->prepare("select * from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $rows1);
 $time1 = $rows1['time_reservation'];
$date2 = $rows1['thedate'];
$stmt = $conn->prepare("select * from doctor where time_id = '$time_id' and status ='Not Available' or time_id=0 and status ='Not Available'");
$stmt->execute();
foreach($stmt as $rows);
$doctor_id = $rows['doctor_id'];
$time_id1 = $rows['time_id'];
$date1 = $rows['date'];
$incharge=$rows['in_charge'];
$status = $rows['status'];
if($grooming_date == ""){

	$as=$numrows+$incharge;	
if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';
}
}
else if($grooming_date == 0)
{}
else{

	if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';	
}
}
}
}
}
echo'
</select>
</div>
</div>
';
}
elseif($theday == 'Saturday')
{
echo '
<div id="time" class="form-group">
<label for="edit_name" class="col-sm-3 control-label">Time</label>
<div class="col-sm-9">
<select class="form-control" id="time" name="time_reservation" required>
<option value="" disabled selected required>---Select---</option>';
$stmt = $conn->prepare("select * from type where type = 'Services'");
$stmt->execute();
foreach($stmt as $r){
$id_type = $r['id_type'];
$stmt = $conn->prepare("select * from schedule where id_type = '$id_type' and day = 'Saturday'");
$stmt->execute();
foreach($stmt as $ro){
$schedule_id = $ro['schedule_id'];
$stmt=$conn->prepare("select * from doctor where date ='$date' and in_charge = 0 and status = 'Not Available'");
$stmt->execute();
foreach($stmt as $gro);
$grooming_date=$gro['time_id'];	
$stmt = $conn->prepare("select * from time where schedule_id='$schedule_id'  and time_id != '$grooming_date'");
$stmt->execute();
foreach($stmt as $row){
$time_id = $row['time_id'];
$time = $row['time_reservation'];
$stmt = $conn->prepare("select *, Count(*)as numrows from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $sss);
$numrows=$sss['numrows'];
$stmt = $conn->prepare("select * from reservation where thedate='$date' and time_reservation = '$time'");
$stmt->execute();
foreach($stmt as $rows1);
 $time1 = $rows1['time_reservation'];
$date2 = $rows1['thedate'];
$stmt = $conn->prepare("select * from doctor where time_id = '$time_id' and status ='Not Available' or time_id=0 and status ='Not Available'");
$stmt->execute();
foreach($stmt as $rows);
$doctor_id = $rows['doctor_id'];
$time_id1 = $rows['time_id'];
$date1 = $rows['date'];
$incharge=$rows['in_charge'];
$status = $rows['status'];

if($grooming_date == ""){

	$as=$numrows+$incharge;	
if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';
}
}
else if($grooming_date == 0)
{}
else{

	if($date == $date2 && $time1 == $time && $as >=2  || $time_id1 == $time_id && $date1 == $date && $status == 'Not Available' && $incharge == 0 ){
echo'<option value="'.$time.'" hidden>'.$time.'</option>';
}

else{
echo'<option value="'.$time.'">'.$time.'</option>';	
}
}
}
}
}
echo'
</select>
</div>
</div>
';
}
}
?>