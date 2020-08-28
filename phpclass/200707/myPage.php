<?php
// 쿠키 생성 : dept = "cominfo"
// setcookie('dept','cominfo');

//setcookie('name','ycjung');
//setcookie('age',23);
//setcookie('dept','cominfo');
//setcookie('univ','Yeungjin Univ');
//setcookie('position','professor');
//setcookie('otherinfo');

setcookie('name','ycjung',time()+5);            // 현재 시간 기준 5초 뒤 쿠키 소멸
setcookie('age',23,time()+60*60*24);            // 현재 시간 기준 1일 뒤 소멸
setcookie('dept','cominfo',0);                  // 브라우저 종류 시 소멸
setcookie('univ','Yeungjin Univ');              // 브라우저 종료 시 소멸
setcookie('position','professor',time()-3600);  // 현 쿠키 삭제, 과거 시간
setcookie('otherinfo');


?>