<?php
  header("content-type:text/html;charset=utf-8");

  //start session
  session_start();
  
  //lowercase the input
  $code=strtolower($_POST['vcode']);  
  $str=strtolower($_SESSION['vstr']); 
  
  //receive and post
  $name=$_POST['username'];
  $pwd=$_POST['password'];
  $repwd=$_POST['repassword'];
  
  //validate if password same
  if($pwd!=$repwd){
    echo"<script>alert('Please Type Password Again');</script>";
    echo"<script>location='datastore.html'</script>";
  }else{
    //validate veri code
    if($code!=$str){  
      echo "<script>alert('Please Try Verification Code Again');</script>";  
      echo"<script>location='datastore.html'</script>";
    }else{  
      //connect php and mysql
      $conn=mysql_connect("localhost","","");
      
      //select db
      mysql_select_db("test");

      //set utf
      mysql_query("set names utf8");

      //insert through php
      $sqlinsert="insert into t1(username,password) values('{$name}','{$pwd}')";

      //select through php
      $sqlselect="select * from t1 order by id";

      //add input into db
      mysql_query($sqlinsert);
      
      //return info
      $result=mysql_query($sqlselect);
      
      echo "<h1>USER INFORMATION</h1>";
      echo "<hr>";
      echo "<table width='700px' border='1px'>";
      //select and extract one line
      echo "<tr>";
      echo "<th>ID</th><th>USERNAME</th><th>PASSWORD</th>";
      echo "</tr>";
      while($row=mysql_fetch_assoc($result)){
        echo "<tr>";
        //print $row

        echo "<td>{$row['id']}</td><td>{$row['username']}</td><td>{$row['password']}</td>";
        
        echo "</tr>";
      }
      echo "</table>";

      //释放连接资源
        //这个页面的主要作用完成了最重要的几个功能。将表单提交的数据都存入变量，然后进行密码和验证码的判断，都正确以后，将用户信息存入数据库并将数据库存放用户信息的表中所有数据提取打印出来。就是数据存入和提取。连接数据库的函数mysql_connect("localhost","username","password")
        
      mysql_close($conn);
              
      } 
  }
?>; $sqlinsert="insert into t1(username,password) values('{$name}','{$pwd}')";