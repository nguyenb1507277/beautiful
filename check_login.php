<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<?php
session_start();
$_SESSION['db_is_logged_in'] = false;
$remember=false;
if(isset($_POST['ok'])){
    if(($_POST['username'] == NULL)&&($_POST['password'] == NULL)) {       
    //echo "Ban khong nhap vao Username va Password " ."<br>";
      header("location:check_login.php");
      } else if($_POST['username'] == NULL){           
       // echo " Ban chua nhap Usernam " ."<br>";
         header("location:check_login.php");
      } else if($_POST['password'] == NULL){         
              //echo " Ban chua nhap Password" ."<br>";
         header("location:check_login.php");
                          

               } else {
          $u=$_POST['username'];
          $p=md5( addslashes($_POST['password']));   
          $connect=mysql_connect("localhost","root","huy") or die("can't connect this database");
          mysql_select_db("shopping",$connect);
          $sql="select * from user where username='".$u."' and password='".$p."'";
          $query=mysql_query($sql);
          if(mysql_num_rows($query)==0) {
             //echo " Ban nhap username va password khong dung " ."<br>";
          header("location:check_login.php");     
          } else {       
                  $row=mysql_fetch_array($query);       
                  $_SESSION['db_is_logged_in'] = true;     
                  $_SESSION['username'] = $row["username"];
                  $_SESSION['id'] = $row["ID"];
                  $_SESSION['password'] = $row["password"]; 
                if (isset($_POST['remember'])) {
                $_SESSION['remember']=true;
                setcookie("remember", $_SESSION['remember'],time()+60*60*24*100);
                $_COOKIE["remember"];
                setcookie("NhapTen", $_SESSION['username'], time()+60*60*24*100, "/");
                $_COOKIE["NhapTen"];
                setcookie("NhapMK", $_SESSION['password'], time()+60*60*24*100, "/");
               $_COOKIE["NhapMK"];                 
              }         
             header("location:management.php"); // kiem tra dung, khong check 
             exit;       
           }
       } 
} else if($_COOKIE["remember"]==true) {
 $_SESSION['db_is_logged_in'] = true;
  header("location:management.php");
  }

?>

<html>
<head>
</head>

<body>


<form action='' method='POST'>

   <table>
   <tr>
    <td>Tên đăng nhập:</td> <td> <input type='text' name='username' value='NhapTen' /> </td>
   </tr>
   
   <tr>
    <td>Mật khẩu:</td> <td> <input type='password' name='password' value ='NhapMK'  /> </td>
   </tr>

   <tr>
    <td align="left" colspan="2" >
     <input type="checkbox" name="remember" /> 
     Ghi nhớ 
    </td>
   </tr>

    <tr>
    <td align="center" colspan="2">
     <input type='submit' name='ok' value='Đăng nhập'
     <input type="reset" name = 'cancel' value = 'Cancel' />  
    </td>
    </tr>
   

   </table>

   </form>
</body>

</html>