<?php

// 검색후 페이징 기능, 버튼의 숫자 조절
if ($searchKeyword != null){            // 검색을 한 경우
    $pagingSql         = $changeSql;    // 쿼리 변경
    $pagingResult      = board_Query::$db_conn->query($pagingSql);
    $totalRowNum       = $pagingResult->num_rows;                           // 전체 row 갯수
    $totalPageNum      = ceil($totalRowNum/$showTextNum);              // 전체 페이지 수
}
// 보여줄 블록의 첫번째 버튼 번호가 1보다 작거나 같은 경우 1로 설정
if ($startPageNum <= 1){ $startPageNum = 1; }
// 보여줄 블록의 마지막 버튼 번호가 마지막 버튼 번호와 크거나 같은 경우 마지막 페이지로 설정
if ($totalPageNum <= $endPageNum) { $endPageNum = $totalPageNum; }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// -->> button 기능
if ($searchKeyword == null) {       // 검색을 안한 경우
    // << 기능
    if ($clickPageButton <= $showButtonNum){ echo "<span><<</span>"; }
    else { ?> <a href="<?php echo BoardInfo::FILENAME_MAIN; ?>?nowPage=<?php echo $startPageNum-1; ?>"><<</a> <?php }
    // < 기능
    if ($clickPageButton <= 1){     // 출력된 블록 안의 클릭된 버튼이 1인 경우, < 클릭 불가
        echo "<span><</span>";
    } else{                         // 출렫된 블록 안의 클릭된 버튼이 1이 아닌 경우, < 클릭 가능
        ?> <a href="<?php echo BoardInfo::FILENAME_MAIN; ?>?nowPage=<?php echo $clickPageButton-1; ?>"><</a> <?php
    }
    // 버튼 출력
    for ($num = $startPageNum; $num <= $endPageNum; $num++){
        if ($num == $clickPageButton){      // 출력된 블록 안의 클릭된 숫자의 경우, 클릭 불가
            ?> <span  style="color: red"><?php echo $num; ?></span> <?php
        } else{                             // 출력된 블록 안의 클릭되지 않은 숫자의 경우, 클릭 가능
            ?> <a href="<?php echo BoardInfo::FILENAME_MAIN; ?>?nowPage=<?php echo $num; ?>"><?php echo $num; ?></a> <?php
        }
    }
    // > 기능
    if ($clickPageButton >= $totalPageNum){     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값인 경우, > 클릭 불가
        echo "<span>></span>";
    } else{                                     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값이 아닌 경우, > 클릭 가능
        ?> <a href="main?nowPage=<?php echo $clickPageButton+1; ?>">></a> <?php
    }
    // >> 기능
    if ($endPageNum >= $totalPageNum){ echo "<span>>></span>"; }
    else { ?> <a href="main?nowPage=<?php echo $endPageNum+1; ?>">>></a> <? }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else {                              // 검색을 한 경우
    // << 기능
    if ($clickPageButton <= $showButtonNum){ echo "<span><<</span>"; }
    else {
        ?> <a href="<?php echo BoardInfo::FILENAME_MAIN; ?>?nowPage=<?php echo $searchKeyword; ?>&searchText=<?php echo $searchText; ?>&searchBtn=검색&nowPage=<?php echo $startPageNum-1; ?>"><<</a> <?
    }
    // < 기능
    if ($clickPageButton <= 1){     // 출력된 블록 안의 클릭된 버튼이 1인 경우, < 클릭 불가
        echo "<span><</span>";
    } else{                         // 출렫된 블록 안의 클릭된 버튼이 1이 아닌 경우, < 클릭 가능
        ?> <a href="<?php echo BoardInfo::FILENAME_MAIN; ?>?keyword=<?php echo $searchKeyword; ?>&searchText=<?php echo $searchText; ?>&searchBtn=검색&nowPage=<?php echo $clickPageButton-1; ?>"><</a> <?php
    }
    // 버튼 출력
    for ($num = $startPageNum; $num <= $endPageNum; $num++){
        if ($num == $clickPageButton){      // 출력된 블록 안의 클릭된 숫자의 경우, 클릭 불가
            ?> <span  style="color: red"><?php echo $num; ?></span> <?php
        } else{                             // 출력된 블록 안의 클릭되지 않은 숫자의 경우, 클릭 가능
            ?> <a href="<?php echo BoardInfo::FILENAME_MAIN; ?>?keyword=<?php echo $searchKeyword; ?>&searchText=<?php echo $searchText; ?>&searchBtn=검색&nowPage=<?php echo $num; ?>"><?php echo $num; ?></a> <?php
        }
    }
    // > 기능
    if ($clickPageButton >= $totalPageNum){     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값인 경우, > 클릭 불가
        echo "<span>></span>";
    } else{                                     // 출력된 블록 안의 클릭된 버튼이 버튼의 마지막 값이 아닌 경우, > 클릭 가능
        ?> <a href="<?php echo BoardInfo::FILENAME_MAIN; ?>?keyword=<?php echo $searchKeyword; ?>&searchText=<?php echo $searchText; ?>&searchBtn=검색&nowPage=<?php echo $clickPageButton+1; ?>">></a> <?php
    }
    // >> 기능
    if ($endPageNum >= $totalPageNum){
        echo "<span>>></span>";
    } else {
        ?> <a href="<?php echo BoardInfo::FILENAME_MAIN; ?>?keyword=<?php echo $searchKeyword; ?>&searchText=<?php echo $searchText; ?>&searchBtn=검색&nowPage=<?php echo $endPageNum+1; ?>">>></a> <?
    }
}
// button 기능 <<--





