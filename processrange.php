<?php
        $connect=mysqli_connect('localhost','root','rameena123','test'); 
        if(mysqli_connect_errno($connect))
        {
		      echo 'Failed to connect';
        } 
        //Execute the query
        if(!empty($_POST['year1']))	$year1=$_POST['year1'];	
        else $year1="NULL";

        if(!empty($_POST['month1']))	$month1=$_POST['month1'];	
        else $month1="NULL";

        if(!empty($_POST['day1']))	$day1=$_POST['day1'];	
        else $day1="NULL";

        if(!empty($_POST['year2']))	$year2=$_POST['year2'];	
        else $year2="NULL";

        if(!empty($_POST['month2']))	$month2=$_POST['month2'];	
        else $month2="NULL";

        if(!empty($_POST['day2']))	$day=$_POST['day2'];	
        else $day2="NULL";

        if(!empty($_POST['mag']))	$mag=$_POST['mag'];	
        else $mag="NULL";
        //only magnitude
        if(($day1=="NULL")&&($month1=="NULL")&&($year1=="NULL")&&($day2=="NULL")&&($month2=="NULL")&&($year2=="NULL")&&!($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE e.`Magnitude - (Richter scale)`>$mag";
        else if(($day1=="NULL")&&($month1=="NULL")&&!($year1=="NULL")&&($day2=="NULL")&&($month2=="NULL")&&($year2=="NULL")&&($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE e.`Year`=$year1";
        //year and magnitude
        else if(($day1=="NULL")&&($month1=="NULL")&&!($year1=="NULL")&&($day2=="NULL")&&($month2=="NULL")&&($year2=="NULL")&&!($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Magnitude - (Richter scale)`>$mag)&&(e.`Year`=$year1)";
        //month year magnitude
        else if(($day1=="NULL")&&!($month1=="NULL")&&!($year1=="NULL")&&($day2=="NULL")&&($month2=="NULL")&&($year2=="NULL")&&!($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Magnitude - (Richter scale)`>$mag)&&(e.`Year`=$year1)&&(e.`Month`=$month1)";
        //day month year magnitude
        else if(!($day1=="NULL")&&!($month1=="NULL")&&!($year1=="NULL")&&($day2=="NULL")&&($month2=="NULL")&&($year2=="NULL")&&!($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Magnitude - (Richter scale)`>$mag)&&(e.`Year`=$year1)&&(e.`Month`=$month1)&&(e.`day`=$day1)";
        //month year
        else if(($day1=="NULL")&&!($month1=="NULL")&&!($year1=="NULL")&&($day2=="NULL")&&($month2=="NULL")&&($year2=="NULL")&&($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Year`=$year1)&&(e.`Month`=$month1)";
        //day month year
        else if(!($day1=="NULL")&&!($month1=="NULL")&&!($year1=="NULL")&&($day2=="NULL")&&($month2=="NULL")&&($year2=="NULL")&&($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Year`=$year1)&&(e.`Month`=$month1)&&(e.`day`=$day1)";
        //only year dual
        else if(($day1=="NULL")&&($month1=="NULL")&&!($year1=="NULL")&&($day2=="NULL")&&($month2=="NULL")&&!($year2=="NULL")&&($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Year`>=$year1) && (e.`Year`<=$year2)";
        //year and magnitude dual
        else if(($day1=="NULL")&&($month1=="NULL")&&!($year1=="NULL")&&($day2=="NULL")&&($month2=="NULL")&&!($year2=="NULL")&&!($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Magnitude - (Richter scale)`>$mag)&&(e.`Year`>=$year1) && (e.`Year`<=$year2)";
        //month year magnitude dual
        else if(($day1=="NULL")&&!($month1=="NULL")&&!($year1=="NULL")&&($day2=="NULL")&&!($month2=="NULL")&&!($year2=="NULL")&&!($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Magnitude - (Richter scale)`>$mag)&&(e.`Year`>=$year1) && (e.`Year`<=$year2)&&(e.`Month`>=$month1)&&(e.`Month`<=$month2)";
        //day month year magnitude dual
        else if(!($day1=="NULL")&&!($month1=="NULL")&&!($year1=="NULL")&&!($day2=="NULL")&&!($month2=="NULL")&&!($year2=="NULL")&&!($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Magnitude - (Richter scale)`>$mag)&&(e.`Year`>=$year1) && (e.`Year`<=$year2)&&(e.`Month`>=$month1)&&(e.`Month`<=$month2)&&(e.`day`>=$day1)&&(e.`day`<=$day2)";
        //month year dual
        else if(($day1=="NULL")&&!($month1=="NULL")&&!($year1=="NULL")&&($day2=="NULL")&&!($month2=="NULL")&&!($year2=="NULL")&&($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Year`>=$year1) && (e.`Year`<=$year2)&&(e.`Month`>=$month1)&&(e.`Month`<=$month2)";
        //day month year dual
        else if(!($day1=="NULL")&&!($month1=="NULL")&&!($year1=="NULL")&&!($day2=="NULL")&&!($month2=="NULL")&&!($year2=="NULL")&&($mag=="NULL"))
            $sql = "SELECT * FROM earthquake AS e WHERE (e.`Year`>=$year1) && (e.`Year`<=$year2)&&(e.`Month`>=$month1)&&(e.`Month`<=$month2)&&(e.`day`>=$day1)&&(e.`day`<=$day2)";
        else
            $sql = "SELECT * FROM earthquake AS e";

            $result = mysqli_query($connect, $sql);
            $result1 = mysqli_query($connect, $sql);
            $result2 = mysqli_query($connect, $sql);
            $result3 = mysqli_query($connect, $sql);
            $result4 = mysqli_query($connect, $sql);

    ?>  