<!--paging.php-->

<html>
<head>
	<title>페이징 실습</title>
	<meta charset="utf-8">
</head>

<body>
	<table border="1" width="600">
		<thead>
			<tr>
				<th>글번호</th>
				<th>작성자</th>
				<th>글제목</th>
				<th>작성일</th>
				<th>조회수</th>
			</tr>
		</thead>
		
		<?php 
		if(isset($_GET["nowPage"])){
			$nowPage=$_GET["nowPage"];
			$nowBlock=$_GET["nowBlock"];
		}else{
			$nowPage=1;
			$nowBlock=1;
		}
		
		$conn=mysqli_connect("localhost","root","123456","testdb");
		$queryAll="select * from gongji";
		$rs=mysqli_query($conn,$queryAll);
		$totPage=ceil(mysqli_num_rows($rs)/10);
		$totBlock=ceil($totPage/10);
		echo "총 페이지수: ".$totPage."<br>총 블록 수: ".$totBlock."<br>현재 페이지 번호: ".$nowPage."<br>현재 블록 번호: ".$nowBlock;

		$startDataRow=($nowPage-1)*10;
		$queryLimit="select * from gongji order by no desc limit $startDataRow,10";
		$rsLimit=mysqli_query($conn,$queryLimit);
		echo "<br>시작데이터 줄번호: ".$startDataRow;

		?>
		
		<tfoot>
		
			<caption style="text-align:left;caption-side:bottom"><br>
				<?php 
					$nowBlock=ceil($nowPage/10);
					//prev
					if($nowBlock>1){
						$prevBlock=$nowBlock-1;
						$prevStartPage=($prevBlock-1)*10+1;
						print "<a href='paging.php?nowPage=$prevStartPage&nowBlock=$prevBlock'>prev</a>";
						echo "&nbsp;&nbsp;";
					}
					//중앙 ... 메인 숫자들
					$startPage=($nowBlock-1)*10+1;
					$endPage=$startPage+9;
					for($i=$startPage;$i<=$endPage;$i++){
						if($nowPage==$i) $col="red";
						else $col="#cccccc";
						
						if($i>$totPage){break;}//페이지 더 없으면 넘어강
						echo " <a href='paging.php?nowPage=$i&nowBlock=$nowBlock'>
						<font color=$col>".$i."</font></a> ";
					}
					//next
					if($nowBlock<$totBlock){
						echo "&nbsp;&nbsp;";
						$nextBlock=$nowBlock+1;
						$nextStartPage=($nextBlock-1)*10+1;
						print " <a href='paging.php?nowPage=$nextStartPage&nowBlock=$nextBlock'>next</a>";
					}
				?>
				<br>
				<br>
				<button type="button" onclick="location.href='notice_write.php'">새글쓰기</button>
			</caption>
			
		</tfoot>
		<tbody>
			<?php while($row=mysqli_fetch_array($rsLimit)){?>
			<tr>
				<td><?php echo $row["no"]?></td>
				<td><?php echo $row["name"]?></td>
				<td><?php echo $row["title"]?></td>
				<td><?php echo $row["writeday"]?></td>
				<td><?php echo $row["hit"]?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</body>

</html>
<!--
create table gongji(
no int auto_increment primary key
,name varchar(30)
,title varchar(50)
,content text
,writeday varchar(30)
,hit int default 0
);
-->