<?php
include_once('./adbconfig.php'); //단순 function 모음
include_once('./c_m.php'); //단순 function 모음
include_once('./class_bas.php');

$urlarray=parse_url($_SERVER['REQUEST_URI']);
if(isset($urlarray['query'])){
	parse_str($urlarray['query']);
}

?>
<META http-equiv="Content-Type" CONTENT="text/html; charset=utf-8">

<?php
fontstyle(1);
class stock extends bas{

    function stock(){
  
		$this->bas();
		$this->dailydata="stockprice";
		$this->stockdata="stockbook";
		$this->naverdaily="stocknaver";
		$this->stockai="stockai";
		$this->naverdata="stocknaver";
		$this->menu();
		
		if(   (isset($_GET['a']))  &&  (strlen(trim($_GET['a']))>0)   ) {
			$a=$_GET['a'];
	        if(!strstr($a,"_")){	
				$a="stock_list";
			}
		}else{
			$a="stock_list";
		}
        $this->$a();         		
    }
	function menu(){
	    ?>
			<center>
			<table width=600>
			<tr>
			<td>
			<a href="?a=stock_home">
			▶홈
			</a>
			</td>
			<td>
			<a href="?a=stock_list">
			▶목록
			</a>
			</td>

			<td>
			<a href="?a=stock_slide">
			▶슬라이드
			</a>
			</td>
			<td>
			<a href="?a=stock_navershow">
			▶네이버데이타
			</a>
			</td>
			<td>
			<a href="?a=stock_dailyshow">
			▶일별데이타
			</a>
			</td>
			<td>
			
			<?php 
			searchtableform("ff","종목검색","","stock_search","","");
			?>
			</td>
			</tr></table>
			</center>
        <?php		
	}
	function stock_home(){
		?>	

			<center>
			<h1>주식시장</h1>
			<a href="?a=stock_list">목록으로 가기</a>
			<a href="?a=stock_phpinfo">php info</a>

			<br>
			<center>
			<table><tr><td>


				<a href='http://finance.daum.net/item/chart.daum?type=B&code=P1' target='_blank'>
				<img src='http://imgfinance.naver.net/chart/main/KOSPI.png?sidcode=1449242888527' border=0 width=250 height=150>
				</a>



			</td>
			<td>
            <center>
            <?php


			
			echo '<table border="0" cellspacing="0" cellpadding="0">';
            $filename="icons/stockhead.jpg";
			//$filename="http://cichart.moneta.kr/pax/chart/candleChart/V201200/paxCandleChartV201200Daily.jsp?abbrSymbol=002000";
			$info =getimagesize($filename);

            $extension =image_type_to_extension($info[2]);			


            if($extension==".png"){
				$im =imagecreatefrompng($filename);
			}
            elseif($extension==".jpeg"){
				$im =imagecreatefromjpeg($filename);
			}
			$width = imagesx($im);
			$height = imagesy($im);
			for ($cy=0;$cy<$height;$cy++) {
			  echo '<tr>';
			  for ($cx=0;$cx<$width;$cx++) {
				$rgb = ImageColorAt($im, $cx, $cy);
				$col = imagecolorsforindex($im, $rgb); 
				printf('<td width="1" height="1" bgcolor=#%02x%02x%02x></td>', $col["red"], $col["green"], $col["blue"]);
			  }
			  echo '</tr>';
			}
			echo '</table>';


			
			
			?>
			<script type="text/javascript" src="http://www.phppowerarts.com/jarvis-chat/widget"></script>
			</td>
			<td>
				<a href='http://finance.daum.net/item/chart.daum?type=B&code=Q1' target='_blank'>
				<img src='http://imgfinance.naver.net/chart/main/KOSDAQ.png?sidcode=1449242888529' border=0 width=250 height=150>
				</a>
			
			</td>
			</tr>
			</table>
			
			<br>
			<center>
			<table cellspacing=1 cellpadding=1>
			<tr>
			<td>

			<a href='#' onClick="window.open('http://m.blog.naver.com/the_cpa/220739120261','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">일자별 주가검색및 엑셀전환방법</a>
			</td>
			</tr>
			<tr>
			<td>
			<a href='#' onClick="window.open('http://marketdata.krx.co.kr/mdi#document=040204','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">일자별 주가검색및 엑셀전환</a>
			</td>
			</tr>

			<tr>
			<td>
			<a href='#' onClick="window.open('http://api.finance.naver.com/service/itemSummary.nhn?itemcode=256840','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">네이버제이슨</a>
			</td>
			</tr>
			<tr>
			<td>
			<a href='#' onClick="window.open('http://polling.finance.naver.com/api/realtime.nhn?query=SERVICE_ITEM:256840','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">네이버폴링</a>
			</td>
			</tr>
			
			<tr>
			<td>
			<a href='#' onClick="window.open('http://finance.naver.com/item/frgn.nhn?code=256840','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">외국인,기관별</a>
			</td>
			</tr>
			<tr>
			<td>
			<tr>
			<td>
			<a href='#' onClick="window.open('http://finance.naver.com/item/sise_day.nhn?code=195440','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">네이버일자별주가</a>
			</td>
			</tr>
			<tr>
			<td>

			<a href='#' onClick="window.open('http://finance.naver.com/item/sise_time.nhn?code=256840&thistime=20170112153030','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">네이버시간별주가</a>
			</td>
			</tr>
			<tr>
			<td>
			<a href='#' onClick="window.open('http://kind.krx.co.kr/corpgeneral/corpList.do?method=loadInitPage','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">상장법인목록 및 엑셀다운</a>
			</td>
			</tr>

			
			</table>
			</center>


		<?php
		
		
	}
	function stock_tablemake(){
		
		$query="CREATE TABLE stocklist (
          id int(8) not null auto_increment,
          stockname varchar(80) not null default '',
          code char(6) not null default '',
		  bizkind varchar(255) not null default '',
		  bizgoods varchar(255) not null default '',
		  sangdate char(12) not null default '',
		  magamdal varchar(10) not null default '',
		  president varchar(20) not null default '',
		  homep varchar(80) not null default '',
		  location varchar(80) not null default '',
          PRIMARY KEY (id),
		  index stockname(stockname),
		  index code(code),
		  index bizkind(bizkind),
		  index bizgoods(bizgoods),
          index homep(homep)
		  )";
        $this->connection->query($query);  //////////고객데이타를 만듬
	
		
        $query="CREATE TABLE stockprice(
		  dateinfo char(8) not null default '',
          code char(6) not null default '',
          nowprice int(8) unsigned not null default 0,
		  risefall tinyint(1) unsigned not null default 0,
          diff int(8) not null default 0,
          rate float(8) not null default 0,
		  start int(8) unsigned not null default 0,
		  high int(8) unsigned not null default 0,
		  low int(8) unsigned not null default 0,
		  quant int(10) unsigned not null default 0,
          index dateinfo(dateinfo),
		  index code(code),
		  index nowprice(nowprice),
		  index risefall(risefall),
		  index diff(diff),
		  index rate(rate)
        )";
        $this->connection->query($query);  //////////고객데이타를 만듬

        $query="CREATE TABLE stockdaily(
		  dateinfo char(8) not null default '',
          code char(6) not null default '',
          nowprice int(8) unsigned not null default 0,
		  risefall tinyint(1) unsigned not null default 0,
          diff int(8) unsigned not null default 0,
          rate float(8) unsigned not null default 0,
		  start int(8) unsigned not null default 0,
		  high int(8) unsigned not null default 0,
		  low int(8) unsigned not null default 0,
		  quant int(10) unsigned not null default 0,
          index dateinfo(dateinfo),
		  index code(code),
		  index nowprice(nowprice),
		  index risefall(risefall),
		  index diff(diff),
		  index rate(rate),
		  index quant(quant)
        )";
        $this->connection->query($query);  //////////고객데이타를 만듬
		
        $query="CREATE TABLE stocktime(
		  time char(8) not null default '',
          code char(6) not null default '',
          nowprice int(8) unsigned not null default 0,
		  risefall tinyint(1) unsigned not null default 0,
          diff int(7) not null default 0,
		  rate float(4,2) not null default 0,
		  quant int(10) unsigned not null default 0,
          index dateinfo(time),
		  index code(code),
		  index nowprice(nowprice),
		  index risefall(risefall),
		  index diff(diff),
		  index rate(rate),
		  index quant(quant)
        )";
        $this->connection->query($query); 
		//////////고객데이타를 만듬
		
        $query="CREATE TABLE stocknaver(
          dateinfo char(8) not null default '',
		  code char(6) not null default '',
          nowprice int(8) unsigned not null default 0,
		  risefall tinyint(1) unsigned not null default 0,
          diff int(8) not null default 0,
          rate float(8) not null default 0.00,
		  start int(8) unsigned not null default 0,
		  high int(8) unsigned not null default 0,
		  low int(8) unsigned not null default 0,
		  quant int(10) unsigned not null default 0,
		  avg20 int(8) unsigned not null default 0,
		  avg60 int(8) unsigned not null default 0,
		  avgquant int(8) unsigned not null default 0,
		  foreigner int(8) unsigned not null default 0,
		  institute int(8) unsigned not null default 0,
          index dateinfo(dateinfo),
		  index code(code),
		  index nowprice(nowprice),
		  index risefall(risefall),
		  index diff(diff),
		  index rate(rate),
		  index avg20(avg20),
		  index avg60(avg60),
		  index avgquant(avgquant),
		  index foreigner(foreigner),
		  index institute(institute)
        )";
        $this->connection->query($query);  //////////고객데이타를 만듬

	}
	
	function graphkind($whatid="dddd"){
		parse_str(getm());
		parse_str(postm());
		if(!isset($gae)){$gae=4;}
		if(!isset($style)){$style="random";}
		if(!isset($kind)){$kind="daily";}
		
		if(!isset($page)){$page=1;}
		
		?>
			<script>
			   function choosekind<?php echo$whatid;?>(a){
				  gochoosekind<?php echo$whatid;?>.kind.value=a;
				  gochoosekind<?php echo$whatid;?>.submit();
			   }
			
			</script>
			<form name='gochoosekind<?php echo$whatid;?>' enctype='multipart/form-data'  style='margin-bottom:0;margin-top:0' method=post action="?a=<?php echo$_REQUEST['a'];?>">
			<input type="hidden" name=kind value="">
			<input type="hidden" name=page value="<?php echo$page;?>">				
			<input type="hidden" name=gae value="<?php echo$gae;?>">
			<input type="hidden" name=style value="<?php echo$style;?>">
			</form>		

		    <table>
			<tr>
			<td><span onclick="choosekind<?php echo$whatid;?>('5min');" style="cursor:hand;"><?php if($kind=='5min'){?><font color=red>▶5분간</font><?php }else{?>▶5분간<?php } ?></span></td>
			<td><span onclick="choosekind<?php echo$whatid;?>('daily');" style="cursor:hand;"><?php if($kind=='daily'){?><font color=red>▶일간</font><?php }else{?>▶일간<?php } ?></span></td>
			<td><span onclick="choosekind<?php echo$whatid;?>('weekly');" style="cursor:hand;"><?php if($kind=='weekly'){?><font color=red>▶주간</font><?php }else{?>▶주간<?php } ?></span></td>
			<td><span onclick="choosekind<?php echo$whatid;?>('onemonth');" style="cursor:hand;"><?php if($kind=='onemonth'){?><font color=red>▶다음한달</font><?php }else{?>▶다음한달<?php } ?></span></td>
			<td><span onclick="choosekind<?php echo$whatid;?>('monthly');" style="cursor:hand;"><?php if($kind=='monthly'){?><font color=red>▶월간</font><?php }else{?>▶월간<?php } ?></span></td>
			</tr>
			</table>
		<?php
	}
	function stylechoice($whatid="pppp"){
		parse_str(getm());
		parse_str(postm());
		if(!isset($gae)){$gae=4;}
		if(!isset($page)){$page=1;}
		if(!isset($kind)){$kind="daily";}
		if(!isset($style)){$style="idsun";}

		
		?>
			<script>
			   function choosekind<?php echo$whatid;?>(a){
				  gochoosekind<?php echo$whatid;?>.style.value=a;
				  gochoosekind<?php echo$whatid;?>.submit();
			   }
			
			</script>
			<form name='gochoosekind<?php echo$whatid;?>' enctype='multipart/form-data'  style='margin-bottom:0;margin-top:0' method=post action="?a=<?php echo$_REQUEST['a'];?>">
			<input type="hidden" name=style value="">
			<input type="hidden" name=kind value="<?php echo$kind;?>">
			<input type="hidden" name=page value="<?php echo$page;?>">				
			<input type="hidden" name=gae value="<?php echo$gae;?>">
			</form>		

		    <table>
			<tr>
			<td><span onclick="choosekind<?php echo$whatid;?>('idsun');" style="cursor:hand;"><?php if($style=="idsun"){?><font color=red>▶아디순</font><?php }else{?><font color=black>▶아디순</font><?php } ?></span></td>
			<td><span onclick="choosekind<?php echo$whatid;?>('idban');" style="cursor:hand;"><?php if($style=="idban"){?><font color=red>▶아디역순</font><?php }else{?><font color=black>▶아디역순</font><?php } ?></span></td>
			<td><span onclick="choosekind<?php echo$whatid;?>('random');" style="cursor:hand;"><?php if($style=="random"){?><font color=red>▶무작위</font><?php }else{?><font color=black>▶무작위</font><?php } ?></span></td>
			<td><span onclick="choosekind<?php echo$whatid;?>('namesun');" style="cursor:hand;"><?php if($style=="namesun"){?><font color=red>▶종목명순</font><?php }else{?><font color=black>▶종목명순</font><?php } ?></span></td>
			<td><span onclick="choosekind<?php echo$whatid;?>('nameban');" style="cursor:hand;"><?php if($style=="nameban"){?><font color=red>▶종목역순</font><?php }else{?><font color=black>▶종목역순</font><?php } ?></span></td>
			</tr>
			</table>
		<?php
	}
	
	function stock_list(){
		

		parse_str(getm());
		parse_str(postm());

		//echo __DIR__; //C:\xampp\htdocs\total
		
		if(!isset($kind)){$kind="daily";}
    	if( (!isset($style)) || (strlen(trim($style))=="")){$style="random";}

		$array=array();
		
		if($style=="idsun"){
		    $orderstring="order by id asc";	
		}
		elseif($style=="idban"){
		    $orderstring="order by id desc";	
		}
		elseif($style=="random"){
		    $orderstring=" order by rand()";	
		}
		elseif($style=="namesun"){
		    $orderstring=" order by binary(stockname) asc";	
		}
		elseif($style=="nameban"){
		    $orderstring=" order by binary(stockname) desc";	
		}

		$query = "select stockname,code from $this->stockdata $orderstring";
		$result = $this->connection->query($query);
		
		while($row=$result->fetch_row()){
			$array[$row[0]]=$row[1];
		}
		
        echo "<center>총종목수".count($array)."</center>";
		$filename=basename($_SERVER['PHP_SELF']);
        if(!isset($getdate)){$getdate=date("Ymd");}
        if(!isset($gae)){$gae=3;}

		if($gae==5){
            $pok=200;$nop=120;
			$weekpok="0.1";$weeknop="0.1"; 

			$list_num=50;
        }
        if($gae==4){
            $pok=260;$nop=100;
		    $weekpok='210';$weeknop=110; 

			$list_num=40;
        }
        elseif($gae==3){
            $pok=350;$nop=190;
			$weekpok='10';$weeknop=120; 

			$list_num=100;
        }
        elseif($gae==2){
            $pok=540;$nop=210;
            $weekpok='540';$weeknop=180;                    

			$list_num=40;
        }
        elseif($gae==1){
            $pok='1200';$nop=390;
            $weekpok='1150';$weeknop=390;

			$list_num=30;
        }

        $tablewidth='99%';
		$si=0;

        $action=__FUNCTION__;
		
		if(!isset($page)){$page=1;}

		$link_num=10;
		$totalsu=count($array);
		$start_list_num = ($page-1)*$list_num; 
		
        cpage($xid="5345",$postvar="&action=$action&kind=$kind&gae=$gae&style=$style",makeaddstring("totalsu=$totalsu,list_num=$list_num,link_num=$link_num"),$addstring="");		
		//page는 넣치말것 자동으로 post변수로 들어간다..
		//postvar에 넣으면 무조건 1로 설정된 값이 들어가게 되서  안되고(무조건 1로만 나오게됨)
		//varstring에 넣으면 함수안에서 $_POST['page']값이 있으면 그값으로 되고 그값이 없을때 $page=1이 되는데
	    //거기에 varstring을 parse_str이 되어 개입해서 혼란을 주게된다.....
        //그래서 postvar에도 varstring에도 넣치말고  이 함수를 쓸때는 항상 $_POST['page'] 변수가 안에서 
        //돌아간다고 생각해서 따로넣으려고 하지 말고 혹시 $page가 없어서 에러가 나도 그걸 항상 
        //염두에 두어서 $page변수를 다루어야 한다....		
		
		
		$ar=array_slice($array,$start_list_num,$list_num);
		
                ?>

				<center>
				<table border=1 width=100%>
				<tr>
				<td align=left>
				<?php
				$this->kospishow($width=200);
				?>
				</td>				
				<td>
				<?php $this->graphkind();?>
				<?php $this->stylechoice();?>

				</td>
				<td>
				<?php  
				
				makeform('fff',$filename,"stock_list","kind=$kind&style=$style&page=$page","","gae",'&1=1&2=2&3=3&4=4&5=5');
				//makeform($formid,$filename,$actionname,$postvar,$getvar,$buttonname,$buttonvar)				
				?>
	
				</td>
				<td>
				<a href="?a=<?php echo$_REQUEST['a'];?><?php if(isset($kind)){?>&kind=<?php echo $kind;?> <?php }?>">
				<img src="./icons/medal.png" width=30 border=0>목록 
				</a>

				</center>
				</td>
				<td align=right>
				<?php
				$this->kosdaqshow($width=200);
				?>
				</td>
				</tr>
				</table>
				
				<table border=1 width='<?php echo$tablewidth;?>' cellspacing=2 cellpadding=2>
                <?php 
				

                foreach($ar as $key => $what){

                    if($si%$gae==0){
                    ?>
                    <tr><td valign=top><center>

					<?php $this->eachtitle($what);?><br>
                    <?php 

					$this->stockgraph($what,$kind,$pok,$nop);

					?>
					</td>
                    <?php 
                    $si=0;
                    }
                    elseif($si%$gae==($gae-1)){
                    ?>
                    <td valign=top><center>
					<?php $this->eachtitle($what);?><br>
                    <?php 
					$this->stockgraph($what,$kind,$pok,$nop);
					?>
					</td>
                    <?php 
                    }else{
                    ?>
                    <td valign=top><center>
					<?php $this->eachtitle($what);?><br>
                    <?php 
					$this->stockgraph($what,$kind,$pok,$nop);
					?>

					</td>
                    <?php 
                    }
                    $si=$si+1;
                }
                if ($si<$gae){
                    for ($x=0;$x<$gae-$si;$x++){
                    ?>
                    <td bgcolor='eeeeee'></td>
                    <?php 
                    }
                    ?>
                    </tr>
                    <?php 
                }
                ?>
                </table>
                <?php 

	}
	function namebycode($code){
		$query = "SELECT stockname from $this->stockdata where code='$code'";
		$result = $this->connection->query($query);	
		if($result->num_rows>0){
			$row=$result->fetch_row();
			return $row[0];
		}
	}
    function stockgraph($code,$kind,$width,$height){
	if($width==''){$width=1000;}
	if($height==''){$height=300;}
		
		if($kind=="5min"){
			?>
			<center>
			<table><tr><td>
			<b>5분간</b></td>
			</tr>
			<tr><td>
			<a href="?a=stock_each&code=<?php echo$code;?>">
            <img src="http://imgfinance.naver.net/chart/item/day/<?php echo$code;?>.png?sidcode=1450162688299" width=<?php echo$width;?> height=<?php echo$height;?> border=0>		
		    </a>
			</td></tr></table>
			</center>
			<?php
        }			
		elseif($kind=="daily"){
			?>
			<center>
			<table><tr><td>
			<b>일간</td>
			</tr>
			<tr><td>
			<a href="?a=stock_each&code=<?php echo$code;?>">
			<img src="http://cichart.moneta.kr/pax/chart/candleChart/V201200/paxCandleChartV201200Daily.jsp?abbrSymbol=<?php echo$code;?>" width=<?php echo$width;?> height=<?php echo$height;?> border=0>
			</a>
			</td></tr></table>
			</center>
			<?php
		}
		elseif($kind=="weekly"){
			?>
			<center>
			<table><tr><td>
			<b>주간</td>
			</tr>
			<tr><td>
			<a href="?a=stock_each&code=<?php echo$code;?>">
			<img src="http://cichart.moneta.kr/pax/chart/candleChart/V201200/paxCandleChartV201200Weekly.jsp?abbrSymbol=<?php echo$code;?>&wlog_pip=chart" width=<?php echo$width;?> height=<?php echo$height;?> border=0>
			</a>
			</td></tr></table>
			</center>
			<?php
		}
		elseif($kind=="monthly"){
			?>
			<center>
			<table><tr><td>
			<b>월간</td>
			</tr>
			<tr><td>
			<a href="?a=stock_each&code=<?php echo$code;?>">
			<img src="http://cichart.moneta.kr/pax/chart/candleChart/V201200/paxCandleChartV201200Monthly.jsp?abbrSymbol=<?php echo$code;?>&wlog_pip=chart" width=<?php echo$width;?> height=<?php echo$height;?> border=0>
			</a>
			</td></tr></table>
			</center>
			<?php
		}
		elseif($kind=="1day"){
			?>
			<center>
			<table><tr><td>
			<b>1일</td>
			</tr>
			<tr><td>
			<a href="?a=stock_each&code=<?php echo$code;?>">
			<img src="http://chart.finance.daum.net/time3/real/<?php echo$code;?>-290157.png?date=<?php echo$datetime;?>" width=<?php echo$width;?> height=<?php echo$height;?> border=0>
            </a>
			</td></tr></table>
			</center>
			<?php
			
	    }

		elseif($kind=="onemonth"){
			?>
			<center>
			<table><tr><td>
			<b>1개월</td>
			</tr>
			<tr><td>
			<a href="?a=stock_each&code=<?php echo$code;?>">
			<img src="http://chart.finance.daum.net/candle3/<?php echo$code;?>-290157.png?date=<?php echo$datetime;?>" width=<?php echo$width;?> height=<?php echo$height;?> border=0>
            </a>
			</td></tr></table>
			</center>
			<?php
			
	    }
		elseif($kind=="3month"){
			?>
			<center>
			<table><tr><td>
			<b>3개월</td>
			</tr>
			<tr><td>
			<a href="?a=stock_each&code=<?php echo$code;?>">
			<img src="http://chart.finance.daum.net/time3/<?php echo$code;?>-290157.png?date=<?php echo$datetime;?>" width=<?php echo$width;?> height=<?php echo$height;?> border=0>
            </a>
			</td></tr></table>
			</center>
			<?php
			
	    }
		elseif($kind=="1year"){
			?>
			<center>
			<table><tr><td>
			<b>1년</td>
			</tr>
			<tr><td>
			<a href="?a=stock_each&code=<?php echo$code;?>">
			<img src="http://chart.finance.daum.net/time3/year/<?php echo$code;?>-290157.png?date=201701141003?date=<?php echo$datetime;?>" width=<?php echo$width;?> height=<?php echo$height;?> border=0>
            </a>
			</td></tr></table>
			</center>
			<?php
			
	    }
		elseif($kind=="3year"){
			?>
			<center>
			<table><tr><td>
			<b>3년</td>
			</tr>
			<tr><td>
			<a href="?a=stock_each&code=<?php echo$code;?>">
			<img src="http://chart.finance.daum.net/time3/3year/<?php echo$code;?>-290157.png?date=201701141003?date=<?php echo$datetime;?>" width=<?php echo$width;?> height=<?php echo$height;?> border=0>
            </a>
			</td></tr></table>
			</center>
			<?php
			
	    }
				
	}
	function stock_alldata(){
		
		parse_str(getm());
		if(!isset($_GET['id'])){
		     $_GET['id']=1;	
		}
		$id=$_GET['id'];
		headcap($id);
		/// 시간대별가격정보
		////http://finance.naver.com/item/sise_time.nhn?code=067280&thistime=20170112153030
		////시간대별주가정보끝
		
		
		$totalsu=obtaintotalsu($this->stockdata,"id='$id'");
		if($totalsu>0){
				rgoto("","stock_doalldata","&id=$id");
		}
		
	}
	function stock_codeamend(){
		$query = "select * from $this->stockdata";

		$result = $this->connection->query($query);
		if ($result){
				while($row=$result->fetch_assoc()){	
                    $code=$row['code'];	
                    $originalcode=$code;					
                    $code=trim($code);
                    $code=str_replace(" ","",$code);
                   if(strlen($code)==2){
						$code="0000".$code;
						
					}					
                    elseif(strlen($code)==3){
						$code="000".$code;
						
					}					
                    elseif(strlen($code)==4){
						$code="00".$code;
						
					}					
                    elseif(strlen($code)==5){
						$code="0".$code;
						
					}			
					echo $originalcode; echo "-"; echo $code;echo "<br>";
					if($originalcode!=$code){
						$bquery = "UPDATE $this->stockdata SET code='$code' WHERE code='$originalcode' ";
						$bresult = $this->connection->query($bquery);						
                    }
				}
		}				
	    
		

	}
	function stock_doalldata(){
		$startpage=1;$endpage=2;
		parse_str(getm());
		set_time_limit(120);
		if(!isset($_GET['id'])){
		     $_GET['id']=1;	
		}
		$id=$_GET['id'];
		if(!isset($id)){$id=1;}
		$query="select stockname,code from $this->stockdata where id=$id";
		$result=$this->connection->query($query);			
		if($result->num_rows>0){
			$row=$result->fetch_assoc();
			$code = $row['code'];
				//echo $row['stockname'];echo "<br><br>";
			for ($pa=$startpage;$pa<=$endpage;$pa++){

				 $array=$this->naverprice($code,$page=$pa);
					 //print_r($array);					 
					 //echo "<br>";
				 $this->naverpriceinsert($code,$array);
				     //echo "--------------------------------------------";echo"<br>";				
			}
		}		
		$id=$id+1;

			rgoto("","stock_alldata","&id=$id");


	}
	function naverpriceinsert($code,$array){
		$arraysu=count($array);
		// //risefall 1상한2상승 3 보통 4.하한 5.하락

		if($arraysu>0){
			for($i=0;$i<$arraysu-1;$i=$i+8){
				$array[$i]=trim($array[$i]);
				if( (strlen(trim($array[$i]))>0)   &&  ( $array[$i]!="&nbsp;")  ){
					$j=$i;
					
					$dateinfo=$array[$j];
					$dateinfo=str_replace('.','',$dateinfo);
					
					$nowprice=$array[$j+1];
					$risefall=$array[$j+2];
					$diff=$array[$j+3];
					if(trim($risefall)=="upright"){$rf=1;}//상한
					elseif(trim($risefall)=="up"){$rf=2;}//상승
					elseif(trim($risefall)=="same"){$rf=3;}//보합
					elseif(trim($risefall)=="downright"){$rf=4;$diff=$diff*(-1);} ///하한
					elseif(trim($risefall)=="down"){$rf=5;$diff=$diff*(-1);}///하락
					
					$rate=round(($diff/($nowprice-$diff))*100,2);
					
					$start=$array[$j+4];
					$high=$array[$j+5];
					$low=$array[$j+6];
					$quant=$array[$j+7];

					$totalsu=obtaintotalsu($this->dailydata," dateinfo='$dateinfo' and code='$code' " );


					if($totalsu<1){
						if( strlen(trim($dateinfo))==8 ){
							$query = "INSERT INTO $this->dailydata (dateinfo,code,nowprice,risefall,diff,rate,start,high,low,quant) VALUES ('$dateinfo','$code','$nowprice','$rf','$diff','$rate','$start','$high','$low','$quant')";
							$this->connection->query($query);
						}
					}else{
						//$query = "UPDATE $this->dailydata SET nowprice='$nowprice',risefall='$rf',diff='$diff',start='$start',high='$high',low='$low',quant='$quant' WHERE dateinfo='$dateinfo' and code='$code' ";
						//$result = $this->connection->query($query);						
					}

				}
			}
		}
	}	
	function naverprice($code,$page){/////매일 데이타를 가져옴
		
     	$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "http://finance.naver.com/item/sise_day.nhn?code=$code&page=$page");
		///아이템사이트
		$result = curl_exec($ch);
    
		curl_close($ch);
		$result=iconv("euc-kr", "utf-8", $result);		
        //echo $result;
		$linearray=explode("\n",$result);

		$linesu=count($linearray);
        $start=false;
		$string="";
		$array=array();
		for ($i=0;$i<$linesu;$i++){
			if(strlen(trim($linearray[$i]))>0){
				if ( ($start==true) &&   ( strpos($linearray[$i],"<!--- 페이지 네비게이션 시작--->"))   ){
					///<div>가 나오면 기록 중지
					 $start=false;
				}			
				if($start==true){		
				    if (   (  strpos($linearray[$i],"num")!= false )  &&  ( strpos($linearray[$i],">0<")!= false)  ){
						$linearray[$i]=str_replace('>0<',">0<",$linearray[$i]);
					}
				    if (   (  strpos($linearray[$i],"num")!= true )  &&  ( strpos($linearray[$i],">0<")!= false)  ){
						$linearray[$i]=str_replace('>0<',">same"."\n"."0<",$linearray[$i]);
					}
				    if (    strpos($linearray[$i],"ico_up02.gif")!= false  ){
						$linearray[$i]=str_replace($linearray[$i],"upright",$linearray[$i]);
					}
				    if (    strpos($linearray[$i],"ico_down02.gif")!= false  ){
						$linearray[$i]=str_replace($linearray[$i],"downright",$linearray[$i]);
					}
					$string.=$linearray[$i]."\n";  	
				}
				
				if (   strpos($linearray[$i],"일별</span>시세")!= false  ){
					 //<span>외국인 기관</span>이 나오면 기록시작
					 $start=true;
				} 
			}
			
		}
		$string=str_replace('하락">','">down',$string);
		$string=str_replace('상승">','">up',$string);

		//echo "<br>";
		//$string=str_replace('<span class="tah p11 nv01">','<span class="tah p11 nv01">하락</td><td>',$string);
		//$string=str_replace('<span class="tah p11 nv02">','<span class="tah p11 nv01">상승',$string);
		//$string=str_replace('<em class="sam"><span>보합</span></em>','<em class="sam"><span>보합</span></em>'."\n"."0",$string);
		//$string=str_replace('상향','a',$string);
		//$string=str_replace('상한가','a',$string);
		//$string=str_replace('하향','b',$string);
		//$string=str_replace('하한가','b',$string);
		//$string=str_replace('보합','c',$string);		
		//$string=explode("\n",strip_tags($string));
		//echo $string;
		//echo "<br>";
		$linearray=explode("\n",strip_tags($string));
		$linesu=count($linearray);
		for ($i=0;$i<$linesu;$i++){
		    if(obtainstringtype($linearray[$i])!="한글"){
				if(strlen(trim($linearray[$i]))>0){
					//$linearray[$i]=str_replace("/","",$linearray[$i]);
					$linearray[$i]=str_replace("+","",$linearray[$i]);
					$linearray[$i]=str_replace(",","",$linearray[$i]);					
					
					$array[]=$linearray[$i];
				}
			}
		}
		
		return($array);
	
	}
	function recentgongsi($code){
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "http://dart.fss.or.kr/api/search.json?auth=a255d6bfb7093d709b6d06ea3391ab2228892cca&crp_cd=$code&start_dt=19990101");
		///아이템사이트
		$result = curl_exec($ch);
		curl_close($ch);      
        return json_decode($result);		

    	//err_code":"000","err_msg":"정상","crp_nm":"(주)이퓨쳐","crp_nm_e":"e-future.Co.,Ltd.","crp_nm_i":"이퓨쳐","stock_cd":"134060","ceo_nm":"황경호","crp_cls":"K","crp_no":"1101111860083","bsn_no":"2148647520","adr":"서울특별시 송파구 백제고분로 91 4층","hm_url":"-","ir_url":"","phn_no":"02-3400-0509","fax_no":"02-591-7626","ind_cd":"58111","est_dt":"20000121","acc_mt":"12"}		
		
	}
	
	function companyitem($code){
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "http://dart.fss.or.kr/api/company.json?auth=a255d6bfb7093d709b6d06ea3391ab2228892cca&crp_cd=$code");
		///아이템사이트
		$result = curl_exec($ch);
		curl_close($ch);      
        return json_decode($result);		

    	//err_code":"000","err_msg":"정상","crp_nm":"(주)이퓨쳐","crp_nm_e":"e-future.Co.,Ltd.","crp_nm_i":"이퓨쳐","stock_cd":"134060","ceo_nm":"황경호","crp_cls":"K","crp_no":"1101111860083","bsn_no":"2148647520","adr":"서울특별시 송파구 백제고분로 91 4층","hm_url":"-","ir_url":"","phn_no":"02-3400-0509","fax_no":"02-591-7626","ind_cd":"58111","est_dt":"20000121","acc_mt":"12"}		
		
	}
	
	function companydetail($code){

		
		
		?>
              <center>회사 기본정보
              <?php
			  $com=$this->companyitem($code);
              ?>
			  <table cellspacing=5 cellpadding=5 border=1 bordercolor=skyblue style="border-collapse:collapse;">
			  <tr><td>정식명칭(crp_nm)</td><td>  <?php echo$com->{'crp_nm'};?>       </td></tr>
			  <tr><td>영문명칭(crp_nm_e)         </td><td> <?php echo$com->{'crp_nm_e'};?>   </td></tr>
			  <tr><td>종목명(crp_nm_i)         </td><td> <?php echo$com->{'crp_nm_i'};?>   </td></tr>
			  <tr><td>대표자명(ceo_nm)      </td><td> <?php echo$com->{'ceo_nm'};?>   </td></tr>
			  <tr><td> 법인구분(crp_cls)        </td><td> <?php echo$com->{'crp_cls'};?>    </td></tr>
			  <tr><td>법인등록번호(crp_no)</td><td> <?php echo$com->{'crp_no'};?>    </td></tr>
			  <tr><td>사업자등록번호(bsn_no)         </td><td>   <?php echo$com->{'bsn_no'};?>     </td></tr>
			  <tr><td>주소(adr)         </td><td>  <?php echo$com->{'adr'};?>    </td></tr>
			  <tr><td>대표자명(ceo_nm)      </td><td> <?php echo$com->{'ceo_nm'};?>    </td></tr>
			  <tr><td> 홈페이지(hm_url)        </td>
			  <td> 
			     <?php 
				 if (substr($com->{'hm_url'},0,4)=='www.'){
				    $com->{'hm_url'}="http://".$com->{'hm_url'};
				 }
				 ?>    
			     <a href="<?php echo $com->{'hm_url'};?>"><?php echo $com->{'hm_url'};?></a>
			  </td></tr>
			  <tr><td> IR홈페이지(ir_url)        </td><td> <?php echo$com->{'ir_url'};?>   </td></tr>
			  <tr><td> 전화번호(phn_no)        </td><td>  <?php echo$com->{'phn_no'};?>    </td></tr>
			  <tr><td> 팩스번호(fax_no)        </td><td> <?php echo$com->{'fax_no'};?>    </td></tr>
			  <tr><td> 업종코드(ind_cd)        </td><td>  <?php echo$com->{'ind_cd'};?>   </td></tr>
			  <tr><td> 설립일(est_dt)        </td><td> <?php echo$com->{'est_dt'};?>    </td></tr>
			  <tr><td> 결산월(acc_mt)      </td><td>  <?php echo$com->{'acc_mt'};?>   </td></tr>
			  </table>
		<?php	  		
	}
	function stock_phpinfo(){
		echo "</td></tr></table>";
		//echo "</td></tr></table>";
		phpinfo();
		
	}
	function stock_grimtext(){
		?>
		<img src="./icons/smallmag.png">
		<form name=grimtextform>
		<textarea rows=30 cols=90>
		<?php 
		echo grimtext("./icons/smallmag.png");
		?>
		</textarea>
		</form>
		<?php
		
	}
	function stock_each(){
		
		parse_str(getm());
		?>
		<center>
		<table width=980 border=0>
		<tr>
		<td width=30%>
            <?php
            $this->kospishow();
            ?>
		</td>
		<td width=40%>
		<center>
		<a href="?a=stock_each&code=<?php echo $_GET['code'];?>">
		<img src="icons/each.jpg" width=60 border=0> 개별종목상세보기</a> <a href="JavaScript:window.location.reload()"><img src="./icons/refresh.png" width=30 border=0>페이지새로고침</a>		
		</center>
		</td>
		<td align=right>
            <?php
            $this->kosdaqshow();
            ?>			
		</td>
		
		</tr>
		</table>
        <table>
		<tr>
		<td width=40%>

			<?php
			$xarray=$this->napricearray($code,$pagesu=2);///외국인 기관 배열얻기
            //print_r($xarray);
			$this->napricebox($xarray);///외국인,기관보기
			?>

		</td>
		<td width=30%>
		<center>
		<?php
		$this->eachtitle($code);
		?>
		</center>
		</td>
		<td align=right>
            <?php
            //$this->eachinfo($code,$pagesu=180);
            ?>			
		</td>
		
		</tr>
		</table>
    		
        <?php		
        $garo="1300"; $sero=310;
		$this->stockgraph($code,'daily',$garo,$sero);
		echo "<br>";
		$this->stockgraph($code,'weekly',$garo,$sero);
		echo "<br>";
		$this->stockgraph($code,'monthly',$garo,$sero);
        ?>
		<center>
			<table width=100% border=1 bordercolor=dddddd>
			<tr bgcolor=eeeeee>
			<td>날짜</td><td>종가</td><td>상태</td><td>차액</td><td>시가</td><td>고가</td><td>저가</td><td>거래량</td></tr>
			<?php
			
			$pagesu=250;
            $predate="";
            $frag=false;
		    for ($pa=1;$pa<$pagesu;$pa++){

			     $array=$this->naverprice($code,$page=$pa);
                 
				 if($array[0]==$predate){
					$frag=true;
					break;
				 }else{
					?>
					<tr><td colspan=8>
					<a href="http://finance.naver.com/item/sise_day.nhn?code=<?php echo$code;?>&page=<?php echo$pa;?>"><?php echo $pa;?></a>
					
					</td></tr>
					<?php 					 
					$this->naverpricebox($array);//이것이 데이타를 표시하는 것임					 
					 
				 }
				 if($frag==true){
					 break;
				 }
				 $predate=$array[0];
                 //$jsonstring=json_encode($array); 제이슨으로 만드는 것임
				 //echo $jsonstring;
				 //$array=json_decode($jsonstring); 제이슨을 다시 배열로 밤드는 것임


		    }


			


			
			?>
			</table>
            <br>			
			
			<table border=0>

			<tr>
			<td>
               <?php $this->companydetail($code);?>
			</td>
			</tr>
			</table>
			
			<br>

			
			<table border=0>
			<tr>
			<td>
              <center>최근공시
               <?php 
			   $arr=$this->recentgongsi($code) ;
			   //print_r($arr);
			   echo "<br>";
			   //$array=$arr->{'list'};
			   //print_r($arr);
			   echo "<br><br>";
			   //foreach($arr as $v){
                   //print_r($v);
				   $v=$arr->{'list'};
                   foreach($v as $value){ 
						echo $value->{'crp_cls'};echo "<br>";
						echo $value->{'crp_nm'};echo "<br>";
						echo $value->{'crp_cd'};echo "<br>";
						echo $value->{'rpt_nm'};echo "<br>";
						echo $value->{'rcp_no'};echo "<br>";
						echo $value->{'flr_nm'};echo "<br>";
						echo $value->{'rcp_dt'};echo "<br>";
						echo $value->{'rmk'};echo "<br>";echo "<br>";
						
				   }
						
				   
			   //}
			   
			   ?>
			</td>
			</tr>
			</table>			
			
			
			</center>
			<?php
		
	}
	function mostlowprice($code){
		$query = "SELECT min(nowprice) from $this->dailydata where code='$code'" ;
		$result = $this->connection->query($query);
		if($result->num_rows>0){
			$row=$result->fetch_row();
            return $row[0];			
		}		
	}
	function mosthighprice($code){
		$query = "SELECT max(nowprice) from $this->dailydata where code='$code'" ;
		$result = $this->connection->query($query);
		if($result->num_rows>0){
			$row=$result->fetch_row();
            return $row[0];			
		}		
	}
	
	function avg605($avg60array){
		if($avg60array[0]>0){
			$b10=($avg60array[0]-$avg60array[10])/$avg60array[0];
			
			$b60=($avg60array[0]-$avg60array[60])/$avg60array[0];
			$b90=($avg60array[0]-$avg60array[90])/$avg60array[0];
			$b120=($avg60array[0]-$avg60array[120])/$avg60array[0];
			$b150=($avg60array[0]-$avg60array[150])/$avg60array[0];
			$b180=($avg60array[0]-$avg60array[180])/$avg60array[0];
	        return round($b10,4)." ".round($b60,4)." ".round($b90,4)." ".round($b120,4)." ".round($b150,4)." ".round($b180,4);
        }
	}
	function avg205($avg20array){
		if($avg20array[0]>0){
			$b10=($avg20array[0]-$avg20array[10])/$avg20array[0];
			$b20=($avg20array[0]-$avg20array[20])/$avg20array[0];
			$b30=($avg20array[0]-$avg20array[30])/$avg20array[0];
			$b40=($avg20array[0]-$avg20array[40])/$avg20array[0];
			$b50=($avg20array[0]-$avg20array[50])/$avg20array[0];
			$b60=($avg20array[0]-$avg20array[60])/$avg20array[0];
		
			return round($b10,4)." ".round($b20,4)." ".round($b30,4)." ".round($b40,4)." ".round($b50,4)." ".round($b60,4);
		}
	}
	
	function eachinfo($code,$pagesu=60){
	    $array=json_decode($this->jsoncode($code,$pagesu));
		//print_r($array);
		foreach($array as $key =>$value){
		    $datearray[]=$key;
            $pricearray[]=$value[0];			
            $risefallarray[]=$value[2];			
            $diffarray[]=$value[3];	
            $ratearray[]=$value[4];
            $quantarray[]=$value[5];			
            $avg20array[]=$value[6];			
            $avg60array[]=$value[7];			
            $avg120array[]=$value[8];			
		}
		
		$nowprice=$pricearray[0];

		  $a60string=$this->avg605($avg60array);
		
		  $a20string=$this->avg205($avg20array);
		  $mindate=min($datearray);
		  $maxdate=max($datearray);
		  $minprice=min($pricearray);
		  $maxprice=max($pricearray);
		  
		  $maxpriceindex=array_search(max($pricearray),$pricearray);
          $maxpricedate=$datearray[$maxpriceindex];
		  $minpriceindex=array_search(min($pricearray),$pricearray);		  
		  $minpricedate=$datearray[$minpriceindex];
		  $datesu=count($datearray);
		?>
		<table border=1><tr>
		<td>
		기간
		</td>
		<td>
		<?php echo "(".min($datearray)."~".max($datearray).")";?>
		</td>
		</tr>
		<tr>
		<td>
		최고가
		</td>
		<td>
		<?php echo "<font color=red>".max($pricearray)."원(".datestring($maxpricedate).")";?>
		</td>
		</tr>
		<tr>
		<td>
		최저가
		</td>
		<td>
		<?php echo "<font color=blue>".min($pricearray)."원(".datestring($minpricedate).")";?>
		</td>
		</tr>
		<tr>
		<td>
	    60일평균가
		</td>
		<td>
		<?php 
		 if($nowprice>$avg60array[0]){
			 $cha=$avg60array[0]-$nowprice;
		     echo "<font color=blue>".$avg60array[0]."</font>(".$nowprice.")(".$cha.")";
		 }else{
			 $cha=$avg60array[0]-$nowprice;
			 echo "<font color=red>".$avg60array[0]."</font>(".$nowprice.")(+".$cha.")"; 
		 }
		?>
		</td>
		</tr>
		<tr>
		<td>
		20일평균가
		</td>
		<td>
		<?php 
		 if($nowprice>$avg20array[0]){
			 $cha=$avg20array[0]-$nowprice;
		     echo "<font color=blue>".$avg20array[0]."</font>(".$nowprice.")(".$cha.")";
		 }else{
			 $cha=$avg20array[0]-$nowprice;
			 echo "<font color=red>".$avg20array[0]."</font>(".$nowprice.")(+".$cha.")"; 
		 }
		?>
		</td>
		</tr>

		<tr>
		<td>
		최저상태
		</td>
		<td>
		<?php echo "(". round(((($nowprice-$minprice)/($maxprice-$minprice))*100),0)  ." %)";?>
		</td>
		</tr>
		<tr>
		<td colspan=2>
		60평균변화(30일가)<br>

		<?php
		echo $a60string;
		    /*
            $a60array=explode("^",$a60string);
            foreach($a60array as $whata60){
				if(strlen(trim($whata60))>0){
					echo $whata60;echo"<br>";
				}
            }
			*/			
		?>
		</td>
		</tr>
		<tr>
		<td colspan=2>
		20평균변화(10일간)<br>
		<?php
            echo $a20string;
		             
		?>
		</td>
		</tr>

		</table>
		<?php

	} 	
	function jsoncode($code,$pagesu=60){//// 데이타를 배열로 만들어서 json 스트링으로 반환
		
			$xx=array();
		    
			if($pagesu<2){return $xx;}
			
		    for ($pa=1;$pa<$pagesu;$pa++){

			     $array=$this->naverprice($code,$page=$pa);
                 $xx=array_merge($xx,$array);
				// $this->naverpricebox($array);
		    }
			
			for($i=0;$i<count($xx);$i=$i+8){
				
				
				if(strlen(trim($xx[$i]))==10){
					

					$xx[$i]=str_replace(".","",$xx[$i]);
					$xx[$i]=str_replace(" ","",$xx[$i]);
					
					$dateinfo=$xx[$i];
					$nowprice=$xx[$i+1];
					$risefall=$xx[$i+2];
					$diff=$xx[$i+3];
					if(trim($risefall)=="up"){
					    $risefall=2;	
					}
					elseif(trim($risefall)=="upright"){
					    $risefall=1;	
					}
					elseif(trim($risefall)=="down"){
					    $risefall=5;	
					}
					elseif(trim($risefall)=="downright"){
					    $risefall=4;	
					}
					elseif(trim($risefall)=="same"){
					    $risefall=3;	
					}

				    if( ( $risefall==4) || ( $risefall==5)  ){
                        if($diff>0){
							$diff=$diff*(-1);
						}
					}
					
					$start=$xx[$i+4];
					$high=$xx[$i+5];
					$low=$xx[$i+6];
					$quant=$xx[$i+7];
					
					$datearray[]=trim($dateinfo);					
					$pricearray[]=trim($nowprice);
					$risefallarray[]=trim($risefall);
					$diffarray[]=trim($diff);
					$startarray[]=trim($start);
					$higharray[]=trim($high);
					$lowarray[]=trim($low);
                    $quantarray[]=trim($quant);
					

		
				}
            }
			$arraysu=count($datearray);
			foreach($datearray as $k => $whatdate){
				$rate=round(($diffarray[$k]/($pricearray[$k]-$diffarray[$k]))*100,2);
		        $i=$k;
				
				
				if($arraysu > ($k+20) ){
					$qarray=array_slice($pricearray,$i,20);	
					$avg20=array_sum($qarray)/sizeof($qarray);
				}
				if($arraysu > ($k+60) ){
					$parray=array_slice($pricearray,$i,60);				
					$avg60=array_sum($parray)/sizeof($parray);
				}
				if($arraysu > ($k+120) ){
					$rarray=array_slice($pricearray,$i,120);	
					$avg120=array_sum($rarray)/sizeof($rarray);
				}

				if($arraysu > ($k+120) ){
					$rarray=array_slice($pricearray,$i,120);	
					$avg120=array_sum($rarray)/sizeof($rarray);
				}
				
				$quantarr=array_slice($quantarray,$i,$arraysu-$i);	
				$avgquant=array_sum($quantarr)/sizeof($quantarr);
				$avgquant=round($avgquant,0);


				if(isset($avg60)){$avg60=round($avg60,0);}else{$avg60=0;}
				if(isset($avg20)){$avg20=round($avg20,0);}else{$avg20=0;}
				if(isset($avg120)){$avg120=round($avg120,0);}else{$avg120=0;}

				$dateperarray[$whatdate]=array($pricearray[$k],$code,$risefallarray[$k],$diffarray[$k],$rate,$quantarray[$k],$avg20,$avg60,$avg120,$avgquant);
			    //echo $k."-".$whatdate; echo "-".$pricearray[$k];echo "-".$risefallarray[$k];echo $diffarray[$k];echo "<br>";	

			}
			$dateperstring=json_encode($dateperarray);
			return $dateperstring;
	}
	function dailyarray($code,$pagesu=60){
		
			$xx=array();
		    
			if($pagesu<2){return $xx;}
			
		    for ($pa=1;$pa<$pagesu;$pa++){

			     $array=$this->naverprice($code,$page=$pa);
                 $xx=array_merge($xx,$array);
				// $this->naverpricebox($array);
		    }
			
			for($i=0;$i<count($xx);$i=$i+8){
				
				
				if(strlen(trim($xx[$i]))==10){
					

					$xx[$i]=str_replace(".","",$xx[$i]);
					$xx[$i]=str_replace(" ","",$xx[$i]);
					
					$dateinfo=$xx[$i];
					$nowprice=$xx[$i+1];
					$risefall=$xx[$i+2];
					$diff=$xx[$i+3];
					if(trim($risefall)=="up"){
					    $risefall=2;	
					}
					elseif(trim($risefall)=="upright"){
					    $risefall=1;	
					}
					elseif(trim($risefall)=="down"){
					    $risefall=5;	
					}
					elseif(trim($risefall)=="downright"){
					    $risefall=4;	
					}
					elseif(trim($risefall)=="same"){
					    $risefall=3;	
					}

				    if( ( $risefall==4) || ( $risefall==5)  ){
                        if($diff>0){
							$diff=$diff*(-1);
						}
					}
					
					$start=$xx[$i+4];
					$high=$xx[$i+5];
					$low=$xx[$i+6];
					$quant=$xx[$i+7];
					
					$datearray[]=trim($dateinfo);					
					$pricearray[]=trim($nowprice);
					$risefallarray[]=trim($risefall);
					$diffarray[]=trim($diff);
					$startarray[]=trim($start);
					$higharray[]=trim($high);
					$lowarray[]=trim($low);
                    $quantarray[]=trim($quant);
					

		
				}
            }
			$arraysu=count($datearray);
			foreach($datearray as $k => $whatdate){
				$rate=round(($diffarray[$k]/($pricearray[$k]-$diffarray[$k]))*100,2);
		        $i=$k;
				
				
				if($arraysu > ($k+20) ){
					$qarray=array_slice($pricearray,$i,20);	
					$avg20=array_sum($qarray)/sizeof($qarray);
				}
				if($arraysu > ($k+60) ){
					$parray=array_slice($pricearray,$i,60);				
					$avg60=array_sum($parray)/sizeof($parray);
				}
				if($arraysu > ($k+120) ){
					$rarray=array_slice($pricearray,$i,120);	
					$avg120=array_sum($rarray)/sizeof($rarray);
				}

				if($arraysu > ($k+120) ){
					$rarray=array_slice($pricearray,$i,120);	
					$avg120=array_sum($rarray)/sizeof($rarray);
				}
				
				$quantarr=array_slice($quantarray,$i,$arraysu-$i);	
				$avgquant=array_sum($quantarr)/sizeof($quantarr);
				$avgquant=round($avgquant,0);


				if(isset($avg60)){$avg60=round($avg60,0);}else{$avg60=0;}
				if(isset($avg20)){$avg20=round($avg20,0);}else{$avg20=0;}
				if(isset($avg120)){$avg120=round($avg120,0);}else{$avg120=0;}

				$dateperarray[$whatdate]=array($pricearray[$k],$code,$risefallarray[$k],$diffarray[$k],$rate,$quantarray[$k],$avg20,$avg60,$avg120,$avgquant);
			    //echo $k."-".$whatdate; echo "-".$pricearray[$k];echo "-".$risefallarray[$k];echo $diffarray[$k];echo "<br>";	

			}
			return $dateperarray;
	}
	
	function shownaver($code){
        $naverpng="iVBORw0KGgoAAAANSUhEUgAAABwAAAAZCAYAAAAiwE4nAAAACXBIWXMAAAsTAAALEwEAmpwYAAAABGdBTUEAALGOfPtRkwAAACBjSFJNAAB6JQAAgIMAAPn/AACA6QAAdTAAAOpgAAA6mAAAF2+SX8VGAAAEvklEQVR42mKMWGl69NvvrypMjMx/GBlAkOH/fwYGBkZGxv9A3r////+DGL+KrdtT9SUs9v/8+4OBk5WHYdP1uQw7bi9n4AaygWoZfvz5Gfvh+5d2Jkamn0DdIL0gY8AAKP0fbCIj4zuAAGL5z/BfEmio2H+Gf0BREISC/wj655/vDIvO908st+235eMQ+vjz9w8Gfg5RhnffXzO8//GKgQlo4r9/jDz//7NLM+ABQAs/AwQQs06oVNbvv7+FQa5kYGDEhEBxFmZWhpdfnon/+/+PR0fcdPsvoC/FuGUYfvz+CaQVGBT5dRi4WPnNX3995sXMxAzWgw0Dff8ZIICYEF7CD7hYuRl231mTdfHFMR+QoSBf6UlYMAgCfSrIJc4gziP7jpGRiaA5AAHEBPYWEQDoOgZgxDAtvzSt78uvzyKgeFQU1GBgBfr+3/8/DBysnD8YwZGF3wcAAcQETCGMDEQCdmYOhscf76muuzq37eff7wxCXGIMYjxSQAt/gyKbkYGI4AIIICYGEgE3Ky/DnrsbUs88PRjGxy7IYCRly/DxxxuGt9+e/QOnRQLuBwggsIWMJFgICjZQHK68PKP32eeHMrzsAgzMwGD99fcnUfoBAojpPzgoSANszOwMLz49lpl/rqvrNzDFmkm5MEjxqDKBfEcoDgECiAkU9v8ZSLaTgYuNl+HQ/W2RRx7uiFMT0QUmKobXwFRKwL7/DAABBEx6/xkJWff//3+sQcvCxMqw6vKs7i+/PkoLcAl9ghQT//GYw8AAEEBM/wnGGdM/YJz9/vvvL4YcKzBogZldbMmFSRMNJW2e8bDzvfj7/y9e8wACiAlafOJU8OfvLwYLWecN3Ox87zAN+w8O2uOP9wRffH4iUJpP8dzff3/wWggQQAQzPrCwZmJlZnvpqhzY/QtYhmKEABAyM7IwbL+1ogJoEA+h0gYggJhAtQEDnlhkZWJjuPjiuJk0n/xkPUnz/d9/f8UStGzAoH2heO31eQc2YOGADwAEEME4BBnw/PMD3qmny74Fa6dkAkuXd7///cJQBy60wYGF30SAAGJiICIfMjMx/fvw8zXnv/8/b8bo51f8+fsba8olBgAEEChbMBEuuJkZvv35yXDm+T4Gb/Wo2bYKHiu+/f5MloUAAcREnDv/M3AwMzLse7CG4ePPdwwBmokFsnzKd0G1P6kAIICYIC0AfFb9Z2BiYGbgYRVk+P7rC8PNN+cYdMTNXqaYVOT9///vL7BSJslCgABiIhTJf4F1HTebELOplDeTjqg9w7NPDxl+//vNoCNhvs1PI7YXW6rFBwACiAmWm/CWf4xMjGxMXAx8bMIMt95cYXj59SkDIzBVBmqnNKmL6J4kxVKAACJU2jJA2ltM4HKTFZhFgOUmw+03F8FOBObRrzEGhVnAKuojyNfEAIAAYvr3/y87KB7wYWAOYGNhZGUAYXZmToanHx8wfAPGJyhktMRMzvlqRNf++feTAVT0oeoFeuc/rDUI8th/VoAAYuFm470BbibCvfof0qCE1ll//v9m4WThfMjJyg0WZv/PAazh3zGA8iIHKyu4rPXTSJj68MNdwwvPjjiwsXL8Bun9B9b/D1SSgUIRhFmAlr8DCDAAFsvlrUzwM0AAAAAASUVORK5CYII=";

		?>
		<a href='#' onClick="window.open('http://finance.naver.com/item/main.nhn?code=<?php echo $code;?>','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">
		<?php textgrim($naverpng);?>
		</a>
        <?php				
	}
	function navershow($code){
        $naverpng="iVBORw0KGgoAAAANSUhEUgAAABwAAAAZCAYAAAAiwE4nAAAACXBIWXMAAAsTAAALEwEAmpwYAAAABGdBTUEAALGOfPtRkwAAACBjSFJNAAB6JQAAgIMAAPn/AACA6QAAdTAAAOpgAAA6mAAAF2+SX8VGAAAEvklEQVR42mKMWGl69NvvrypMjMx/GBlAkOH/fwYGBkZGxv9A3r////+DGL+KrdtT9SUs9v/8+4OBk5WHYdP1uQw7bi9n4AaygWoZfvz5Gfvh+5d2Jkamn0DdIL0gY8AAKP0fbCIj4zuAAGL5z/BfEmio2H+Gf0BREISC/wj655/vDIvO908st+235eMQ+vjz9w8Gfg5RhnffXzO8//GKgQlo4r9/jDz//7NLM+ABQAs/AwQQs06oVNbvv7+FQa5kYGDEhEBxFmZWhpdfnon/+/+PR0fcdPsvoC/FuGUYfvz+CaQVGBT5dRi4WPnNX3995sXMxAzWgw0Dff8ZIICYEF7CD7hYuRl231mTdfHFMR+QoSBf6UlYMAgCfSrIJc4gziP7jpGRiaA5AAHEBPYWEQDoOgZgxDAtvzSt78uvzyKgeFQU1GBgBfr+3/8/DBysnD8YwZGF3wcAAcQETCGMDEQCdmYOhscf76muuzq37eff7wxCXGIMYjxSQAt/gyKbkYGI4AIIICYGEgE3Ky/DnrsbUs88PRjGxy7IYCRly/DxxxuGt9+e/QOnRQLuBwggsIWMJFgICjZQHK68PKP32eeHMrzsAgzMwGD99fcnUfoBAojpPzgoSANszOwMLz49lpl/rqvrNzDFmkm5MEjxqDKBfEcoDgECiAkU9v8ZSLaTgYuNl+HQ/W2RRx7uiFMT0QUmKobXwFRKwL7/DAABBEx6/xkJWff//3+sQcvCxMqw6vKs7i+/PkoLcAl9ghQT//GYw8AAEEBM/wnGGdM/YJz9/vvvL4YcKzBogZldbMmFSRMNJW2e8bDzvfj7/y9e8wACiAlafOJU8OfvLwYLWecN3Ox87zAN+w8O2uOP9wRffH4iUJpP8dzff3/wWggQQAQzPrCwZmJlZnvpqhzY/QtYhmKEABAyM7IwbL+1ogJoEA+h0gYggJhAtQEDnlhkZWJjuPjiuJk0n/xkPUnz/d9/f8UStGzAoH2heO31eQc2YOGADwAEEME4BBnw/PMD3qmny74Fa6dkAkuXd7///cJQBy60wYGF30SAAGJiICIfMjMx/fvw8zXnv/8/b8bo51f8+fsba8olBgAEEChbMBEuuJkZvv35yXDm+T4Gb/Wo2bYKHiu+/f5MloUAAcREnDv/M3AwMzLse7CG4ePPdwwBmokFsnzKd0G1P6kAIICYIC0AfFb9Z2BiYGbgYRVk+P7rC8PNN+cYdMTNXqaYVOT9///vL7BSJslCgABiIhTJf4F1HTebELOplDeTjqg9w7NPDxl+//vNoCNhvs1PI7YXW6rFBwACiAmWm/CWf4xMjGxMXAx8bMIMt95cYXj59SkDIzBVBmqnNKmL6J4kxVKAACJU2jJA2ltM4HKTFZhFgOUmw+03F8FOBObRrzEGhVnAKuojyNfEAIAAYvr3/y87KB7wYWAOYGNhZGUAYXZmToanHx8wfAPGJyhktMRMzvlqRNf++feTAVT0oeoFeuc/rDUI8th/VoAAYuFm470BbibCvfof0qCE1ll//v9m4WThfMjJyg0WZv/PAazh3zGA8iIHKyu4rPXTSJj68MNdwwvPjjiwsXL8Bun9B9b/D1SSgUIRhFmAlr8DCDAAFsvlrUzwM0AAAAAASUVORK5CYII=";

	    ?>
		<a href='#' onClick="window.open('http://finance.naver.com/item/main.nhn?code=<?php echo $code;?>','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">
		<?php textgrim($naverpng);?>
		</a>
        <?php				
	}
	
	function kospishow($width=300){
		if(isset($width)){
			$height=$width/3;
		    $widthstring=" width=$width ";
            $heightstring=" height=$height ";			
		}
		$nowtime=date("YmdHis");
		?>
			<a href='#' onClick="window.open('http://finance.daum.net/item/chart.daum?type=B&code=P1','kospibigchart','scrollbars=yes,toolbar=no,resizable=yes,width=700,height=500,left=0,top=0'); return true">
		<font size=2><b>KOSPI</b></font>
		<br>
				<img src="http://chart.finance.daum.net/index_top/kospi-290125.png?date=<?php echo$nowtime;?>" border=0 <?php echo $widthstring;?>  <?php echo $heightstring;?>>
			
        </a>
        <?php		
	}
	function kosdaqshow($width=300){
		if(isset($width)){
			$height=$width/3;
		    $widthstring=" width=$width ";
            $heightstring=" height=$height ";			
		}
		$nowtime=date("YmdHis");
		?>
		<a href="http://finance.daum.net/item/chart.daum?type=B&code=Q1" target="_blank" border=0>
		<font size=2><b>KOSDAQ</b></font><br>
		<img src="http://chart.finance.daum.net/index_top/kosdaq-290125.png?date=<?php echo$nowtime;?>" border=0 <?php echo $widthstring;?>  <?php echo $heightstring;?>>
		</a>
        <?php		
	}
	
	function naverpricebox($array){
		$arraysu=count($array);
		if($arraysu>0){
			for($i=0;$i<count($array);$i++){
				if($i%8==0){
					echo "<tr>";
				}
				if($i%8==3){
					?>
					<td>
					<?php 
					if(trim($array[$i-1])=="up"){
					
					      echo "<font color=red>+".$array[$i]."</font>";
					}
					if(trim($array[$i-1])=="upright"){
					
					      echo "<font color=red><b>↑".$array[$i]."</b></font>";
					}
					if(trim($array[$i-1])=="downright"){
					
					      echo "<font color=blue><b>↓".$array[$i]."</b></font>";
					}
					if(trim($array[$i-1])=="down"){
					
					      echo "<font color=blue>-".$array[$i]."</font>";
					}
					if(trim($array[$i-1])=="same"){
					
					      echo "<font color=gray>".$array[$i]."</font>";
					}
					?>
					</td>
					<?php
				}else{

					?>
					<td>
					<?php echo $array[$i];?>
					</td>
					<?php
                }

				if($i%8==7){
					echo "</tr>";
				}
 
			}
		}
	}
	
	function randomcode(){
		$query = "SELECT code FROM $this->stockdata order by rand() limit 0,1";
		$result = $this->connection->query($query);
        if($result->num_rows>0){
			$row=$result->fetch_row();
			return $row[0];
        }		
	
	}
	function randomarray($su){
		$query = "SELECT code FROM $this->stockdata order by rand() limit 0,$su";
		$result = $this->connection->query($query);
        if($result->num_rows>0){
			while($row=$result->fetch_row()){
				$array[]=$row[0];
			}
        }		
	    return $array;
	}

	function stock_slide(){
		parse_str(getm());
		$code=$this->randomcode();
		$pngslide="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";
		?>
		<center>
		<table width=980 border=0>
		<tr>
		<td width=30%>
            <?php
            $this->kospishow();
            ?>
		</td>
		<td width=40%>
		<center>
		<a href="?a=stock_slide&code=<?php echo $_GET['code'];?>">
		<img src="data:image/png;base64,<?php echo$pngslide;?>" width=50 border=0> 슬라이드상세보기</a> <a href="JavaScript:window.location.reload()"><img src="./icons/refresh.png" width=30 border=0>페이지새로고침</a>		
		</center>
		</td>
		<td align=right>
            <?php
            $this->kosdaqshow();
            ?>			
		</td>
		
		</tr>
		</table>
        <table>
		<tr>
		<td width=30%>

			<?php
			$xarray=$this->napricearray($code,$pagesu=2);
            //print_r($xarray);
			$this->napricebox($xarray);
			?>

		</td>
		<td width=40%>
		<center>
		<?php
		$this->eachtitle($code);
		?>
		</center>
		</td>
		<td align=right>
            <?php
            $this->eachinfo($code,$pagesu=60);
            ?>			
		</td>
		
		</tr>
		</table>
		<a href="?a=stock_each&code=<?php echo$code;?>">
		<?php
		$this->stockgraph($code,'daily',1000,300);
        ?>
		</a>
		<?php
		echo "<br>";
		$this->stockgraph($code,'weekly',1000,300);
		echo "<br>";
		
		$this->stockgraph($code,'monthly',1000,300);
        ?>
		<script type="text/javascript" language="javascript">
		 <!--
		 window.onload = function(){
		 setTimeout("this.window.location.replace('?a=stock_slide')",8000);
		 }
		 //-->
		 </script>				
		<?php	
	}
	function nowpriceonly($code){
		$fontsize=3;
		$or=$this->naveritem($code);
		if(isset($or)){
			$nowprice=$or->{'now'};
			$risefall=$or->{'risefall'};
			$yesprice=$or->{'now'}-$or->{'diff'};
			$rate=$or->{'rate'};
            $diff=$or->{'diff'};
		}else{
			$nowprice="";
			$yesprice="";
			$rate="";
            $diff="";			
		}
		?>
		<table>
		<tr>
		<td><?php 
			if($rate<0){
			    echo "<font size=$fontsize color=blue><b>".$nowprice."</font>";
			}
			if($rate>0){
			    echo "<font size=$fontsize color=red><b>".$nowprice."</font>";
			}
			if($rate==0){
			    echo "<font size=$fontsize color=gray><b>".$nowprice."</font>";
			}
		?></td>
		</tr>
		<tr>
		<td><?php 
			if($rate<0){
			    echo "<font size=$fontsize color=blue><b>".$diff."</font>";
			}
			if($rate>0){
			    echo "<font size=$fontsize color=red><b>+".$diff."</font>";
			}
			if($rate==0){
			    echo "<font size=$fontsize color=gray><b>".$diff."</font>";
			}
		?>
		</td>
		</tr>
		<tr>
		<td><?php 
			if($rate<0){
			    echo "<font size=$fontsize color=blue><b>".$rate."%</font>";
			}
			if($rate>0){
			    echo "<font size=$fontsize color=red><b>+".$rate."%</font>";
			}
			if($rate==0){
			    echo "<font size=$fontsize color=gray><b>".$rate."%</font>";
			}
		?></td>
		</tr>
		</table>
		<?php
	}
	function eachtitle($code){
		
		$fontsize=4;
		$query = "SELECT stockname,code,bizkind,bizgoods,homep FROM $this->stockdata where code='$code'";
		$result = $this->connection->query($query);	
		if(isset($result)){
			$row=$result->fetch_assoc();
			$stockname=$row['stockname'];			
			$code=$row['code'];
			$bizkind=$row['bizkind'];
			$bizgoods=$row['bizgoods'];
			$homep=$row['homep'];
		}
		$or=$this->naveritem($code);
		if(isset($or)){
			$nowprice=$or->{'now'};
			$yesprice=$or->{'now'}-$or->{'diff'};
			$rate=$or->{'rate'};
            $diff=$or->{'diff'};
		}else{
			$nowprice="";
			$yesprice="";
			$rate="";
            $diff="";			
		}
			?>
			<center>
			<table>

			<tr>
			<td colspan=4>
			<?php
			echo "<b><font size=$fontsize>".$stockname."</font></b>";
			?>
			</td>
			</tr>
			<tr>
			<td><font size=2>전일가</font></td><td><font size=2>현재가</font></td><td><font size=2>변동률</font></td><td><font size=2>변동액</font></td>
			</tr>			
			<tr>
			<td>
			<?php
			    echo "<font color=gray><b>".$yesprice."</b></font>";
            ?>
            </td>			
			<td>
			<?php
			if($rate<0){
			    echo "<font size=$fontsize color=blue><b>".$nowprice."</font>";
			}
			if($rate>0){
			    echo "<font size=$fontsize color=red><b>".$nowprice."</font>";
			}
			if($rate==0){
			    echo "<font size=$fontsize color=gray><b>".$nowprice."</font>";
			}
            ?>
            </td>
            <td>
			<?php
			if($rate<0){
			    echo "<font size=$fontsize color=blue><b>".$rate."%</font>";
			}
			if($rate>0){
			    echo "<font size=$fontsize color=red><b>+".$rate."%</font>";
			}
			if($rate==0){
			    echo "<font size=$fontsize color=gray><b>".$rate."%</font>";
			}
            ?>
            </td>
            <td>
			<?php
			if($rate<0){
			    echo "<font size=$fontsize color=blue><b>".$diff."</font>";
			}
			if($rate>0){
			    echo "<font size=$fontsize color=red><b>+".$diff."</font>";
			}
			if($rate==0){
			    echo "<font size=$fontsize color=gray><b>".$diff."</font>";
			}

            ?>

            </td>
			</tr>
			<tr>
			<td>
			<?php $this->navershow($code);?>
			</td>
			<td>
               <?php
			   if(strlen(trim($homep))>0){
				   
					weblink($homep,"1000","800");
			   }
			   ?>
			   
			</td>
			<td>
            <a href="?a=stock_ai<?php if(isset($code)){?>&code=<?php echo$code;?><?php }?>"> 
            <?php
			$brainpng="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";
			?>
			<img src="./icons/brain.png" width=20 border=0>
			</a>

			   
			</td>
			<td>

				<a href='#' onClick="window.open('http://finance.naver.com/item/sise_day.nhn?code=<?php echo$code;?>','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">日</a>

				<a href='#' onClick="window.open('http://finance.naver.com/item/sise_time.nhn?code=<?php echo$code;?>','naverwin','scrollbars=yes,resizable=no,width=1000,height=700,left=0,top=0');">時</a>

			   
			</td>

            </tr>
			</tr>
			<td colspan=4>
			
			<?php echo "<font size=2>".$bizkind."</font>";?>
			</td>
			</tr>
			<td colspan=4>
			<table width=200><tr><td>
			<?php echo "<font size=2>".$bizgoods."</font>";?>
			</td></tr></table>
			</td>
			</tr>
			</table>

			</center>
			<?php

		
	}	
	function naveritem($code){
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "http://api.finance.naver.com/service/itemSummary.nhn?itemcode=$code");
		///아이템사이트
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
        //return $array;		
        //marketSum:시가총액 => 
		//diff:차액
		//rate:변동비율
		//high:고가
		//low:저가
		//low:저가
		//quant:거래량
		//amount:거래대금
		//now :현재가 
		//[marketSum]26707 [risefall] => 5 [diff] => -300 [rate] => -5.08 [high] => 5990 [low] => 5280 [quant] => 79993 [amount] => 449120 [per] => -74.67 [eps] => -75 [pbr] => 1.5 [now] => 5600 )	
	}

	function stock_dailyeach(){
		set_time_limit(380);

        parse_str(getm());
		
		?>
		<center>
		<b>
		
		<?php 
		$todaydate=todaydate();
		$beforedate=beforeday($getdate);
		$nextdate=nextday($getdate);
		if($getdate==todaydate()){
			?>
			<table><tr>
			<td>
			
			<?php
			echo "<a href='?a=stock_dailyeach&getdate=$beforedate'><font color=red><b> 전일<=== </b></font></a>";			
			?>
			</td>
			<td>
			<?php
			echo "<font color=red><b> 오늘 </b></font>".datestring($getdate)."(<font color=red>".yoil($getdate,$type=3)."</font>)";
			?>
			</td>
			<td>

			</td>
			</tr>
			</table>
			
			<?php
		}else{
			?>
			<table><tr>
			<td>
			
			<?php
			echo "<a href='?a=stock_dailyeach&getdate=$beforedate'><font color=red><b> 전일<=== </b></font></a>";			
			?>
			</td>
			<td>
			<?php
			echo "<a href='?a=stock_dailyeach&getdate=$todaydate'>=>오늘로 </a>".datestring($getdate)."(".yoil($getdate,$type=3).")";
			?>
			</td>
			<td>
			<?php
			echo "<a href='?a=stock_dailyeach&getdate=$nextdate'><font color=red><b>    ===>다음일 </b></font></a>";			
			?>

			</td>
			</tr>
			</table>
			
			<?php
			

		}
		?>
		</b>
		</center>
		<?php
		
		if(  isset($from)   ){
		    $fromtostring=" (  (rate>$from) && (rate<$to)  )  "; 	
		}
		
		if(isset($fromtostring)){
			$query="select code,nowprice,risefall,diff,rate from $this->dailydata where dateinfo='$getdate' and $fromtostring  order by rate desc";
        }else{
			$query="select code,nowprice,risefall,diff,rate from $this->dailydata where dateinfo='$getdate'  order by rate desc";
		
		}
		
        ?>
		<center>
		<table>
		    <tr>
			   <td valign=bottom>
				<table width=600>
					<tr>
					   <td>
						<a href="?a=stock_dailyeach&getdate=<?php echo$getdate;?>&from=0&to=2">
						<font color=red>0%-2%
						</a>
						</span>
					   </td>
					   <td>
						<a href="?a=stock_dailyeach&getdate=<?php echo$getdate;?>&from=2&to=5">
						<font color=red>2%-5%
						</a>
						</span>
					   </td>

					   <td>
						<a href="?a=stock_dailyeach&getdate=<?php echo$getdate;?>&from=5&to=10">
						<font color=red>5%-10%
						</a>
						</span>
					   </td>
					   <td>
						<a href="?a=stock_dailyeach&getdate=<?php echo$getdate;?>&from=10&to=20">
						<font color=red>10%-20이상
						</a>
						</span>
					   </td>

					   <td>
						<a href="?a=stock_dailyeach&getdate=<?php echo$getdate;?>&from=20&to=33">
						<font color=red>20%이상
						</a>
						</span>
					   </td>

					  </tr>
				
					<tr>
					   <td>
						<a href="?a=stock_dailyeach&getdate=<?php echo$getdate;?>&from=-2&to=0">
						<font color=blue>-2%-0%
						</a>
						</span>
					   </td>
					   <td>
						<a href="?a=stock_dailyeach&getdate=<?php echo$getdate;?>&from=-5&to=-2">
						<font color=blue>-5%~-2%
						</a>
						</span>
					   </td>

					   <td>
						<a href="?a=stock_dailyeach&getdate=<?php echo$getdate;?>&from=-10&to=-5">
						<font color=blue>-10%~-5%
						</a>
						</span>
					   </td>
					   <td>
						<a href="?a=stock_dailyeach&getdate=<?php echo$getdate;?>&from=-20&to=-10">
						<font color=blue>-20%~-10%
						</a>
						</span>
					   </td>

					   <td>
						<a href="?a=stock_dailyeach&getdate=<?php echo$getdate;?>&from=-33&to=-20">
						<font color=blue>-30%~-20%
						</a>
						</span>
					   </td>
					   

					  </tr>
				</table>
				</td>
				<td>
				
			   <td rowspan=2>
			   

				<table><tr>
				<td>
				
				<?php
				$beforemonth=beforemonth($getdate);
				$nextmonth=nextmonth($getdate);				
				echo "<a href='?a=stock_dailyeach&getdate=$beforemonth'><font color=red><b> 전달<= </b></font></a>";			
				?>
				</td>
				<td>
				<?php
				echo "<a href='?a=stock_dailyeach&getdate=$todaydate'>=>이번달</a>".monthday($getdate);
				?>
				</td>
				<td>
				<?php
				echo "<a href='?a=stock_dailyeach&getdate=$nextmonth'><font color=red><b>=>다음달 </b></font></a>";			
				?>

				</td>
				</tr>
				</table>

			   <?php 
			   $this->monthbody($getdate,32,10,$linkto='stock_dailyeach');
			   ?>
			   
			   </td>
			</tr>
         </table>			
		<?php	   
			   
		$result=$this->connection->query($query);
		if ($result->num_rows>0){
			echo $result->num_rows;
			?>
			<center>
			총 <font color=red><?php echo $result->num_rows;?></font> 개 종목의 데이타 (<?php echo datestring($getdate);echo yoil($getdate);?>) <br>
			<table width=1100 border=1 bordercolor=eeeeee style='border-collapse:collapse;'>
			<?php
			
			while($row=$result->fetch_row()){	
               $code=$row[0];	
			   $nowprice=$row[1];
			   
               $risefall=$row[2];	
               $diff=$row[3];
			   $rate=$row[4];
              //rate=round(($diff/($nowprice+$diff))*100,2);
				
			   //$bquery = "UPDATE $this->dailydata SET rate='$rate' WHERE dateinfo='$getdate' and code='$code' ";
			   //$bresult = $this->connection->query($bquery);						
			   
			   ?>			   
			   <tr>
			   <td>
			   <a href="?a=stock_each&code=<?php echo $code;?>">
			   <?php 
			   echo $this->namebycode($row[0]);
			   ?>
			   </a>
			   </td>
			   
			   
			   <td valign=top>
			   <?php 

			   if($getdate!=todaydate()){
					$this->nowpriceonly($code);
			   }			  
			   ?><br>
			   <?php 
			   if( ($risefall==2) ||  ($risefall==1) ){
				   echo "<font color=red>".moneycomma($row[1]);
			   }
			   if( ($risefall==4) ||  ($risefall==5) ){
				   echo "<font color=blue>".moneycomma($row[1]);
			   }
			   if( ($risefall==3) ){
				   echo "<font color=gray>".moneycomma($row[1]);
			   }
			   ?>
               </td>
			   <td>
			   <?php 
			   if( ($risefall==2) ||  ($risefall==1) ){
				   echo "<font color=red>+".moneycomma($row[3]);
			   }
			   if( ($risefall==4) ||  ($risefall==5) ){
				   echo "<font color=blue>".moneycomma($row[3]);
			   }
			   if( ($risefall==3) ){
				   echo "<font color=gray>".moneycomma($row[3]);
			   }
			   ?>
               </td>
			   <td>
			   <?php 
			   if( ($risefall==2) ||  ($risefall==1) ){
				   echo "<font color=red>+".$rate."%</font>";
			   }
			   if( ($risefall==4) ||  ($risefall==5) ){
				   echo "<font color=blue>".$rate."%</font>";
			   }
			   if( ($risefall==3) ){
				   echo "<font color=gray>".$rate."%</font>";
			   }

			   ?>
			   </td>

			   
			   <td>
			   <?php 

				$this->stockgraph($code,'daily','700','200');

			   ?>
			   </td>			   
			   <td>
			   <?php 
			   echo$this->navershow($code);
			   ?>
			   </td>			   

               </tr>
			   <?php
			
			}
			?>
			</table>
			<?php
		}   		
	}
	function stock_dailyshow(){
		$carlendarpng="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";
		$wastepng="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";
		$grandtotal=obtaintotalsu($this->dailydata,"");
		
		$query="select dateinfo from $this->dailydata group by dateinfo";
		$result=$this->connection->query($query);
		if ($result->num_rows>0){
			while($row=$result->fetch_row()){				   
				 $array[]=$row[0];
			}
			$mindate=min($array);
			$maxdate=max($array);
			echo "<center>".datestring($mindate).'~'.datestring($maxdate)."(레코드총갯수:<font color=red><b>".commamake($grandtotal,2)."</b></font>)</center>"; 	
 
		}
		

		
		$query="select dateinfo from $this->dailydata group by dateinfo order by dateinfo desc limit 0,50";
		$result=$this->connection->query($query);
		
		if ($result->num_rows>0){
			?>
            <center>			
            <table cellspacing=2 cellpadding=2>
			<tr>
			<td>
			<?php $this->kospishow();?>
			</td>
            <td>			
			<center>
			<img src="data:image/png;base64,<?php echo $carlendarpng;?>" width=42 border=0><br>
			총 <font color=red><?php echo $result->num_rows;?></font> 일의 일별 데이타 <br>
			</td>
			<td>
			<?php $this->kosdaqshow();?>  
			</td>
			</tr>
			</table>
			<table width=900 border=1 bordercolor=eeeeee style='border-collapse:collapse;'>
			<?php			
			while($row=$result->fetch_row()){				   
			   $totalsu=obtaintotalsu($this->dailydata,"dateinfo='$row[0]'");
			   ?>			   
			   <tr>
			   <td>
			   <a href="?a=stock_dailyeach&getdate=<?php echo $row[0];?>"><?php echo datestring($row[0]);?></a>
			   </td>
			   <td>
			   <?php echo yoil($row[0],3);?>
			   </td>			   
			   <td>
			   <?php echo $totalsu;?>
			   </td>			   
			   <td>
			   <?php echo obtaintotalsu("stockdaily","dateinfo='$row[0]'");?>
			   </td>			   
			   <td>
			   <?php echo datestring($row[0]);?>일자 데이타 
			   </td>
			   <td>
				<a href="?a=stock_dailyeach&getdate=<?php echo $row[0];?>&from=0&to=2">
				0%-2%
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_dailyeach&getdate=<?php echo $row[0];?>&from=2&to=5">
				2%-5%
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_dailyeach&getdate=<?php echo $row[0];?>&from=5&to=10">
				5%-10%
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_dailyeach&getdate=<?php echo $row[0];?>&from=10&to=20">
				10%-20이상
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_dailyeach&getdate=<?php echo $row[0];?>&from=20&to=33">
				20%이상
				</a>
				</span>
			   </td>			   
			   <td>
				<span onclick="if(confirm('<?php echo datestring($row[0]);?>의 데이타를 정말삭제하겠습니까? 영원이 삭제됩니다.!! ')){return true;}else{return false;}">
				<a href="?a=stock_dailydelete&getdate=<?php echo $row[0];?>">
				<img src="data:image/png;base64,<?php echo $wastepng;?>" width=22 border=0>삭제</a>
				</span>
			   </td>
               </tr>
			   <?php			
			}
			?>
			</table>			
			<?php
		}   			
	}
	function stock_dailydelete(){

		parse_str(getm());
        if( (isset($getdate))  && (strlen(trim($getdate))>0) ){
			$query = "delete from $this->dailydata WHERE dateinfo='$getdate'";
			$result = $this->connection->query($query);
			rgoto('',"dailyshow","");
		}
        if( (isset($code))  && (strlen(trim($code))>0) ){
			$query = "delete from $this->dailydata WHERE code='$code'";
			$result = $this->connection->query($query);
			rgoto('',"dailyshow","");
		}
	}	
	
	

	function stock_navereach(){
		set_time_limit(380);

        parse_str(getm());
		
		?>
		<center>
		<b>
		
		<?php echo datestring($getdate);?>
		</b>
		</center>
		<?php
		
		if(  isset($from)   ){
		    $fromtostring=" (  (rate>$from) && (rate<$to)  )  "; 	
		}
		
		if(isset($fromtostring)){
			$query="select code,nowprice,risefall,diff,rate from $this->naverdata where dateinfo='$getdate' and $fromtostring  order by rate desc";
        }else{
			$query="select code,nowprice,risefall,diff,rate from $this->naverdata where dateinfo='$getdate'  order by rate desc";
		
		}
		
        ?>
		<center>
		<table>
		    <tr>
			   <td valign=bottom>
			   <table width=600><tr>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo$getdate;?>&from=0&to=2">
				<font color=red>0%-2%
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo$getdate;?>&from=2&to=5">
				<font color=red>2%-5%
				</a>
				</span>
			   </td>

			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo$getdate;?>&from=5&to=10">
				<font color=red>5%-10%
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo$getdate;?>&from=10&to=20">
				<font color=red>10%-20이상
				</a>
				</span>
			   </td>

			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo$getdate;?>&from=20&to=33">
				<font color=red>20%이상
				</a>
				</span>
			   </td>


			  </tr>
		
		    <tr>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo$getdate;?>&from=-2&to=0">
				<font color=blue>-2%-0%
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo$getdate;?>&from=-5&to=-2">
				<font color=blue>-5%~-2%
				</a>
				</span>
			   </td>

			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo$getdate;?>&from=-10&to=-5">
				<font color=blue>-10%~-5%
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo$getdate;?>&from=-20&to=-10">
				<font color=blue>-20%~-10%
				</a>
				</span>
			   </td>

			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo$getdate;?>&from=-33&to=-20">
				<font color=blue>-30%~-20%
				</a>
				</span>
			   </td>
			   </td></tr></table>
			   </td>
			   <td>
               <?php
			   $this->monthbody($getdate,30,10,$linkto='stock_navereach');
			   ?>
			   
			   </td>

			  </tr>
		</table>
		<?php	   
			   
		$result=$this->connection->query($query);
		if ($result->num_rows>0){
			echo $result->num_rows;
			?>
			<center>
			총 <font color=red><?php echo $result->num_rows;?></font> 개 종목의 데이타 (<?php echo datestring($getdate);echo yoil($getdate);?>) <br>
			<table width=1100 border=1 bordercolor=eeeeee style='border-collapse:collapse;'>
			<?php
			
			while($row=$result->fetch_row()){	
               $code=$row[0];	
			   $nowprice=$row[1];
			   
               $risefall=$row[2];	
               $diff=$row[3];
			   $rate=$row[4];
              //rate=round(($diff/($nowprice+$diff))*100,2);
				
			   //$bquery = "UPDATE $this->naverdata SET rate='$rate' WHERE dateinfo='$getdate' and code='$code' ";
			   //$bresult = $this->connection->query($bquery);						
			   
			   ?>			   
			   <tr>
			   <td>
			   <a href="?a=stock_each&code=<?php echo $code;?>">
			   <?php 
			   echo $this->namebycode($row[0]);
			   ?>
			   </a>
			   </td>
			   
			   
			   <td>
			   <?php 
			   if( ($risefall==2) ||  ($risefall==1) ){
				   echo "<font color=red>".moneycomma($row[1]);
			   }
			   if( ($risefall==4) ||  ($risefall==5) ){
				   echo "<font color=blue>".moneycomma($row[1]);
			   }
			   if( ($risefall==3) ){
				   echo "<font color=gray>".moneycomma($row[1]);
			   }
			   ?>
               </td>
			   <td>
			   <?php 
			   if( ($risefall==2) ||  ($risefall==1) ){
				   echo "<font color=red>+".moneycomma($row[3]);
			   }
			   if( ($risefall==4) ||  ($risefall==5) ){
				   echo "<font color=blue>".moneycomma($row[3]);
			   }
			   if( ($risefall==3) ){
				   echo "<font color=gray>".moneycomma($row[3]);
			   }
			   ?>
               </td>
			   <td>
			   <?php 
			   if( ($risefall==2) ||  ($risefall==1) ){
				   echo "<font color=red>+".$rate;
			   }
			   if( ($risefall==4) ||  ($risefall==5) ){
				   echo "<font color=blue>".$rate;
			   }
			   if( ($risefall==3) ){
				   echo "<font color=gray>".$rate;
			   }

			   ?>
			   </td>

			   
			   <td>
			   <?php 			 
					$this->stockgraph($code,'daily','700','200');
			   ?>
			   </td>			   
			   <td>
			   <?php 
			   echo$this->navershow($code);
			   ?>
			   </td>			   

               </tr>
			   <?php
			
			}
			?>
			</table>
			<?php
		}   		
	}
	function stock_navershow(){
		
		$query="select dateinfo from $this->naverdata group by dateinfo order by dateinfo desc limit 0,50";
		$result=$this->connection->query($query);
		if ($result->num_rows>0){
			?>
            <center>			
            <table cellspacing=2 cellpadding=2>
			<tr>
			<td>
			<?php $this->kospishow();?>
			</td>
            <td>			
			<center>총 <font color=red><?php echo $result->num_rows;?></font> 일의 일별 데이타 <br>
			</td>
			<td>
			<?php $this->kosdaqshow();?>  
			</td>
			</tr>
			</table>
			<table width=900 border=1 bordercolor=eeeeee style='border-collapse:collapse;'>
			<?php			
			while($row=$result->fetch_row()){				   
			   $totalsu=obtaintotalsu($this->naverdata,"dateinfo='$row[0]'");
			   ?>			   
			   <tr>
			   <td>
			   <a href="?a=stock_navereach&getdate=<?php echo $row[0];?>"><?php echo datestring($row[0]);?></a>
			   </td>
			   <td>
			   <?php echo yoil($row[0],3);?>
			   </td>			   
			   <td>
			   <?php echo $totalsu;?>
			   </td>			   
			   <td>
			   <?php echo obtaintotalsu("stocknaver","dateinfo='$row[0]'");?>
			   </td>			   
			   <td>
			   <?php echo datestring($row[0]);?>일자 데이타 
			   </td>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo $row[0];?>&from=0&to=2">
				0%-2%
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo $row[0];?>&from=2&to=5">
				2%-5%
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo $row[0];?>&from=5&to=10">
				5%-10%
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo $row[0];?>&from=10&to=20">
				10%-20이상
				</a>
				</span>
			   </td>
			   <td>
				<a href="?a=stock_navereach&getdate=<?php echo $row[0];?>&from=20&to=33">
				20%이상
				</a>
				</span>
			   </td>			   
			   <td>
				<span onclick="if(confirm('<?php echo datestring($row[0]);?>의 데이타를 정말삭제하겠습니까? 영원이 삭제됩니다.!! ')){return true;}else{return false;}">
				<a href="?a=stock_naverdelete&getdate=<?php echo $row[0];?>"><img src="./icons/delete.gif">삭제</a>
				</span>
			   </td>
               </tr>
			   <?php			
			}
			?>
			</table>			
			<?php
		}   			
	}
	function stock_naverdelete(){

		parse_str(getm());
        if( (isset($getdate))  && (strlen(trim($getdate))>0) ){
			$query = "delete from $this->naverdata WHERE dateinfo='$getdate'";
			$result = $this->connection->query($query);
			rgoto('',"navershow","");
		}
        if( (isset($code))  && (strlen(trim($code))>0) ){
			$query = "delete from $this->naverdata WHERE code='$code'";
			$result = $this->connection->query($query);
			rgoto('',"stock_navershow","");
		}
	}	
	
	
	function monthbody($getdate,$pok,$nop,$linkto){

			if(!isset($getdate)){$getdate=date('Ymd');}
			if(isset($userid)){$useridstring=" and userid='$userid' ";}else{$useridstring="";}
			if(!isset($daysum)){$daysum=0;}
			
			$gong=gongname($getdate);

			foreach($gong as $k=>$v){
			    $gongarray[]=$k;	
				$gongname[]=$v;
			}

			$todaydate=date('Ymd');
			$yy=substr($getdate,0,4);
			$mm=substr($getdate,4,2);
			$dd=substr($getdate,6,2);
			if ((strlen($mm)==2) && (substr($mm,0,1)=="0")){$mm=str_replace("0","",$mm);}
			$lastday=array(31,28,31,30,31,30,31,31,30,31,30,31);// 각 달의 마지막 날 지정
			$dayname=array('일','월','화','수','목','금','토');// 요일명 지정
			if($yy%4==0 && $yy%100!=0 || $yy%400==0) $lastday[1]=29;  // 윤년 계산을 통해 2월의 마지막 날 계산
			$total=($yy-1)*365+(int)(($yy-1)/4) - (int)(($yy-1)/100) + (int)(($yy-1)/400); // 전해까지 평년 기준으로 날짜수 계산 및 윤년의 횟수를 더함
			for($i=0;$i<$mm-1;$i++) $total+=$lastday[$i];// 전달까지의 날짜수 더함
			$total++;// 그 달의 1일
			$sday=$total%7;// 시작 요일을 구함 (0-일요일,...,6-토요일)

			$todaypic='pveye.gif';
		   ?>
		   <center>
		   <br>
		   <table border=1 bordercolor=lightseagreen>
			  <tr bgcolor=<?php echo seecolor(1,'small');?>>
				 <?php // 년 - 월 출력
				 for($i=0;$i<7;$i++){ // 요일명 출력
					if($i==0) echo("<td align='center' width='$pok'><span class=kosmallred><b>$dayname[$i]</font></td>\n");
					else if($i==6) echo("<td align='center' width='$pok'><span class=kosmallblue><b>$dayname[$i]</b></font></td>\n");
					else echo("<td align='center' width='$pok'><span class=kosmallblack><b>$dayname[$i]</td>\n");
				 }
				 echo("</tr>\n<tr>");
						// 처음부터 시작 요일값까진 공백처리
				 if ($sday>0){
					$priormm=$mm-1;
					if ($priormm<1){
					   $prioryy=$yy-1;$priormm=12;
					}else{
					   $prioryy=$yy;
					   $priormm=$mm-1;
					}
					$xxx=0;
					for ($i=$lastday[$priormm-1]-($sday-1);$i<=$lastday[$priormm-1];$i++){
					   $xxx=$xxx+1;
					   if (strlen($priormm)==1){$priormm='0'.$priormm;}
					   if (strlen($i)==1){$i='0'.$i;}
					   $objectdate=$prioryy.$priormm.$i;
					   ?>
					   <td align='right' valign='top' width='<?php echo$pok;?>' height='<?php echo $nop;?>'  bgcolor=eeeeee>
						  <font color=gray><?php echo$i;?></font>

					   </td>
					   <?php
					}
				 }
				 unset($xxx);
				 $c=$sday;// 임시변수는 시작 요일값으로 지정
				 for($i=1;$i<=$lastday[$mm-1];$i++) { // 1부터 해당 월의 마지막 날까지 반복
					$c++;// 임시 변수 증가
					$chk=$c%7;
					if (strlen($mm)==1){$mm='0'.$mm;}
					if (strlen($i)==1){$i='0'.$i;}
					$objectdate=$yy.$mm.$i;
					if($chk==1){ //일요일
						?>
					    <td align='right' valign='top' width='<?php echo$pok;?>' height='<?php echo $nop;?>' <?php if ($objectdate==$todaydate) {?>background='./icons/<?php echo$todaypic;?>'<?php }elseif($objectdate==$getdate){?> bgcolor=yellow <?php } ?>>

							 <a href="?a=<?php echo $linkto;?>&getdate=<?php echo $objectdate;?>">
							 <?php
                             if(  (in_array($objectdate,$gongarray) ) ){
								 ?>
								 <font color=red><?php echo$i;?></font>
								 <?php
						     }else{
								 ?>
								 <font color=red><?php echo$i;?></font>
								 <?php
						     }
							 ?>
							 </a>

						</td>
						<?php

					}
					elseif(!$chk){    //토요일
					   ?>
					  <td align='right' valign='top' width='<?php echo$pok;?>' height='<?php echo $nop;?>' <?php if ($objectdate==$todaydate) {?>background='./icons/<?php echo$todaypic;?>'<?php }elseif($objectdate==$getdate){?> bgcolor=yellow <?php } ?>>
							 <a href="?a=<?php echo $linkto;?>&getdate=<?php echo $objectdate;?>">
							 <?php
                             if(  (in_array($objectdate,$gongarray) ) ){
								 ?>
								 <font color=red><?php echo$i;?></font>
								 <?php
						     }else{
								 ?>
								 <font color=blue><?php echo$i;?></font>
								 <?php
						     }
							 ?>
							 </a>
					   </td>
					<?php
					}else{    //중간
					   ?>
					   <td align='right' valign='top' width='<?php echo$pok;?>' height='<?php echo $nop;?>' <?php if ($objectdate==$todaydate) {?>background='./icons/<?php echo$todaypic;?>'<?php }elseif($objectdate==$getdate){?> bgcolor=yellow <?php } ?>>
							 <a href="?a=<?php echo $linkto;?>&getdate=<?php echo $objectdate;?>">
							 <?php
                             if(  (in_array($objectdate,$gongarray) ) ){
								 ?>
								 <font color=red><?php  echo$i;?></font>
								 <?php
						     }else{
								 ?>
								 <?php echo$i;?>
								 <?php
						     }
							 ?>
							 </a>

						</td>
						<?php
						
					}
					if(!$chk&&$i!=$lastday[$mm-1]){
					   echo("</tr>\n<tr>");// 7로 나눠 떨어지면 다음줄로 (토요일마다 다음줄)
					   $daysum=0;
					}else{ $daysum++;}
				 }
				 $j=0;
				 for($i=$daysum;$i<7;$i++){
					$nextmm=$mm+1;
					if ($nextmm>12){
					   $nextmm='1';$nextyy=$yy+1;
					}else{
					   $nextyy=$yy;
					}
					$j=$j+1;
					if (strlen($nextmm)==1){$nextmm='0'.$nextmm;}
					if (strlen($j)==1){$j='0'.$j;}
					$objectdate=$nextyy.$nextmm.$j;
					?>
					<td height='<?php echo $nop;?>' class='w' align=right valign=top bgcolor=eeeeee>
					   <font color=gray>
					   <?php
					   echo$j;
					   ?>
					   </font>
					</td>
					<?php
				 }
			  ?>
			  </tr>
		   </table>
		   <br>

		   <?php

	}
	

	function napricearray($code,$pagesu=2){ //외국인등 가격
			$juchearray=$this->naverjuche($code);

			for($i=0;$i<count($juchearray);$i=$i+6){
				$juchearray[$i]=trim(str_replace("/","",$juchearray[$i]));
                 $jarray[$juchearray[$i]]=array($juchearray[$i+4],$juchearray[$i+5]);

			}

			$xx=array();
			$returnarray=array();
		    for ($pa=1;$pa<$pagesu;$pa++){
			     $array=$this->naverprice($code,$page=$pa);
                 $xx=array_merge($xx,$array);
				// $this->naverpricebox($array);
		    }			
			for($i=0;$i<count($xx);$i=$i+8){
				if(strlen(trim($xx[$i]))==10){
					$dateinfo=$xx[$i];
					$dateinfo=str_replace(".","",$dateinfo);
					$monday=substr(trim($dateinfo),4,4);

					$nowprice=$xx[$i+1];	
					$risefall=$xx[$i+2];		
					if(trim($risefall)=="up"){
					    $risefall=2;	
					}
					elseif(trim($risefall)=="upright"){
					    $risefall=1;	
					}
					elseif(trim($risefall)=="down"){
					    $risefall=5;	
					}
					elseif(trim($risefall)=="downright"){
					    $risefall=4;	
					}
					elseif(trim($risefall)=="same"){
					    $risefall=3;	
					}

					$diff=$xx[$i+3];
				    if( ( $risefall==4) || ( $risefall==5)  ){
                        if($diff>0){
							$diff=$diff*(-1);
						}
					}
				    $rate=round(($diff/($nowprice-$diff))*100,2);

					
					if(isset($jarray["$monday"])){					
						$returnarray[$dateinfo]=array($nowprice,$risefall,$diff,$rate,$jarray["$monday"][0],$jarray["$monday"][1]);
					}else{					
						$returnarray[$dateinfo]=array($nowprice,$risefall,$diff,$rate,0,0);
					}
				}
            }
			return $returnarray;
	}
	function napricebox($array,$su=7){ //외국인등 가격

		?>
		<table border=1 bordercolor=white>
		<tr bgcolor=eeeeee>
		<td>날짜</td>
		<td>종가</td>
		<td>변동액</td>
		<td>변동률</td>
		<td>외국인</td>
		<td>기관</td>
		</tr>
		<?php 
		$i=1;

		foreach($array as $k=>$v){
			$i=$i+1;
			$nowprice=$v[0];
			$risefall=trim($v[1]);
			$diff=$v[2];
			$rate=$v[3];
			?>
			<tr>
			<td>
			<?php echo monthday(trim($k));?>
			</td>
			<td align=right>
				<?php 		
		
				if(  ($risefall=="1") || ($risefall=="2") ){
					echo "<font color=red> ".$v[0]."</font>";
				}	
				elseif(  ($risefall=="4") || ($risefall=="5") ){
					echo "<font color=blue> ".$v[0]."</font>";
				}	
				elseif(  $risefall=="3" ){
					echo "<font color=gray> ".$v[0]."</font>";
				}	
				?>
			</td>

			<td align=right>
			    <?php
				if(  ($risefall=="1") || ($risefall=="2") ){
					echo "<font color=red> +".$v[2]."</font>";
				}	
				elseif(  ($risefall=="4") || ($risefall=="5") ){
					echo "<font color=blue> ".$v[2]."</font>";
				}	
				elseif(  $risefall=="3" ){
					echo "<font color=gray> ".$v[2]."</font>";
				}	
				?>

			</td>
			<td align=right>
			    <?php
				if(  ($risefall=="1") || ($risefall=="2") ){
					echo "<font color=red> +".$v[3]." %</font>";
				}	
				elseif(  ($risefall=="4") || ($risefall=="5") ){
					echo "<font color=blue> ".$v[3]." %</font>";
				}	
				elseif(  $risefall=="3" ){
					echo "<font color=gray> ".$v[3]." %</font>";
				}	
				?>
			</td>
			<td align=right>
			    <?php 
			    if($v[4]>0){echo "<font color=red>".$v[4]."</font>";}
			    if($v[4]<0){echo "<font color=blue>".$v[4]."</font>";}
			    if($v[4]==0){echo "<font color=gray>".$v[4]."</font>";}				
				?>			
			</td>
			<td align=right>			
			    <?php 
			    if($v[5]>0){echo "<font color=red>".$v[5]."</font>";}
			    if($v[5]<0){echo "<font color=blue>".$v[5]."</font>";}
			    if($v[5]==0){echo "<font color=gray>".$v[5]."</font>";}				
				?>			
			</td>
			</tr>
			<?php
			if($i>$su){break;}
		}
		?>		
		</table>
		<?php
	}

	function naverjuche($code){
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "http://finance.naver.com/item/main.nhn?code=$code");
		///아이템사이트
		$result = curl_exec($ch);
		curl_close($ch);
		$result=iconv("euc-kr", "utf-8", $result);		
		$linearray=explode("\n",$result);

		$linesu=count($linearray);
        $start=false;
		$string="";
		$array=array();
		for ($i=0;$i<$linesu;$i++){
			if(strlen(trim($linearray[$i]))>0){
				if ( ($start==true) &&   ( strpos($linearray[$i],"</div>"))   ){
					///<div>가 나오면 기록 중지
					 $start=false;
				}			
				if($start==true){
				   $string.=$linearray[$i]."\n";  	
				}
				
				if (   strpos($linearray[$i],"<span>외국인 기관</span>")!= false  ){
					 //<span>외국인 기관</span>이 나오면 기록시작
					 $start=true;
				} 
			}
			
		}
		//echo $string;
		//echo "<br>";
		$string=str_replace('<em class="sam"></em>','<em class="sam">0</em>',$string);
		$string=str_replace('<em class="sam"><span>보합</span></em>','<em class="sam"><span>보합</span></em>'."\n"."0",$string);
		$string=str_replace('상향','a',$string);
		$string=str_replace('상한가','a',$string);
		$string=str_replace('하향','b',$string);
		$string=str_replace('하한가','b',$string);
		$string=str_replace('보합','c',$string);		
		//$string=explode("\n",strip_tags($string));
		//echo $string;
		//echo "<br>";
		$linearray=explode("\n",strip_tags($string));
		$linesu=count($linearray);
		for ($i=0;$i<$linesu;$i++){
		    if(obtainstringtype($linearray[$i])!="한글"){
				if(strlen(trim($linearray[$i]))>0){
					//$linearray[$i]=str_replace("/","",$linearray[$i]);
					$linearray[$i]=str_replace("+","",$linearray[$i]);
					$linearray[$i]=str_replace(",","",$linearray[$i]);					
					
					$array[]=$linearray[$i];
				}
			}
		}
        //print_r($array);
		//echo "<br>";
		
		return($array);

	}
	
	function stock_search(){
		?>
		<center>
		<table width=940>
		<tr>
		<td width=30%>
		
		</td>
		<td>
		<center>
		<img src="icons/each.jpg" width=60 border=0> 검색된종목		
		</center>
		</td>
		<td align=right>
		<?php 
		//$this->linkmenu();
		?>
		</td>
		</tr>
		</table>
		</center>
		<?php
		$filename="searchword.txt";
			
		if (file_exists($filename)){
		    $fp=fopen($filename,'r');
		    if(filesize($filename)>0){
				$list=fread($fp,filesize($filename));
			    		
		    }
		    fclose($fp);
			$tok=explode("\n",$list);
		}
		
		if( (isset($_POST['searchword'])) && (strlen(trim($_POST['searchword']))>0) ){
			
			
			$fp=fopen($filename,"w");
            if(!in_array(trim($_POST['searchword']),$tok)){			
				fwrite($fp,$list."\n".trim($_POST['searchword']));
			}else{
				fwrite($fp,$list);				
			}
			fclose($fp);  			
			
		}
		if( (isset($_POST['searchword']))  && ($_POST['searchword']=="달력") ){
			if(file_exists('./c_util.php')){
			    rgoto("","util_calendar","");
			}else{
				
			}
		
		}
		if( (isset($_POST['searchword']))  && ($_POST['searchword']=="음악") ){
			if(file_exists('./c_util.php')){
			    rgoto("","util_video","");
			}else{
				
			}		
		}

		$i=0;
		$query = "select * from $this->stockdata where (stockname like '%$_POST[searchword]%') or (code like '%$_POST[searchword]%')";

		$result = $this->connection->query($query);
		if ($result){
			$totalsu=$result->num_rows;

			if($totalsu>1){
			
				while($row=$result->fetch_assoc()){	
                    $code=$row['code'];				
					if(isset($row['stockname'])){	
					?>
					<center>
					<table><tr>
					<td>
					<?php
					$xarray=$this->napricearray($code,$pagesu=2);
            //print_r($xarray);
					$this->napricebox($xarray);
					?>
					</td>
					<td>
					<?php					
					$this->eachtitle($row['code']);
					?>
					</td>
					<td>
					
					</td>
					</tr>
					</table>
                    <center>
					
					<table width=500>
					<tr><td>
					<?php
					///*
						?>
						<a href="?a=ai_each&code=<?php echo $row['code'];?>">
						<?php $this->stockgraph($row['code'],'daily',"1100","390");?>
						</a>
						<?php
					?>
					</td></tr>
					
					<tr><td align=right>
					<?php
					///*
						?>
						<a href="?a=ai_each&code=<?php echo $row['code'];?>">
						<?php $this->stockgraph($row['code'],'weekly',"900","400");?>
						</a>
						<?php
					?>
					</td></tr>
					
					</table>
					</center>
					<?php
					//*/
					}				
				}				
			}
			if($totalsu==1){
				$row=$result->fetch_assoc();
				rgoto("index.php","stock_each","&code=$row[code]");
				exit;			
			}
			if($totalsu<1){
				echo "<br><br>";
				ohmygodstring();
				?>
				<center>
				<a href="?a=ai_input">
				새종목입력
				</a>
				<?php
			}
		}

	}
	function allcode(){
		$query = "select code from $this->stockdata";
		$result = $this->connection->query($query);
		if ($result->num_rows > 0){
			while($row=$result->fetch_row()){
				$array[]=$row[0];
			}
		}else{

		}
		return $array;
		
	}	
	function stock_naverupdate(){
		$getdate=date("Ymd");
		$query = "select code from $this->stockdata";
		$result = $this->connection->query($query);
		if ($result->num_rows > 0){
			while($row=$result->fetch_row()){
				$totalsu=obtaintotalsu($this->naverdaily,"dateinfo='$getdate' and code='$row[0]'");
                if($totalsu>0){
					$or=$this->naveritem($row[0]);

					
				}else{
					$or=$this->naveritem($row[0]);
					$nowprice=$or->{'now'};
					$risefall=$or->{'risefall'};
					$yesprice=$or->{'now'}-$or->{'diff'};
					$rate=$or->{'rate'};
					$diff=$or->{'diff'};	
                    $high=$or->{'high'};
                    $low=$or->{'low'};
                    $quant=$or->{'quant'};					
				    $bquery="INSERT INTO $this->naverdaily (dateinfo,code,nowprice,risefall,diff,rate,high,low,quant) values ('$getdate','$row[0]','$nowprice','$risefall','$diff','$rate','$high','$low','$quant')";
                    $this->connection->query($bquery);
				}					
			}
		}			
	}
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////	
	
     function stock_ai(){		 
        $allcode=$this->allcode();
		foreach($allcode as $whatcode){
			$array=$this->dailyarray($whatcode,10);
			
			print_r($array);echo "<br><br>";
			
			
			$array1=array_slice($array,0,2);
			print_r($array1);break;
			

		} 
	 }

    function stock_json(){///from table to file
		fontstyle();		
        $f="docuexam";
        if( (isset($f)) && (strlen(trim($f))>0) ){
			@header("Content-type: application/json; charset=utf-8");
			$array=array();
			$query="select * from $f ";
			$result=$this->connection->query($query);
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
						$array[]=$row;				
				}
			}
			$string=json_encode($array,JSON_UNESCAPED_UNICODE);//
			//php 버전 5.6이상에서 JSON_UNESCAPED_UNICODE 명령어가 가능한 것임...가능한것임 
			?>
			<table width="100%"><tr><td><?php echo $string;?></td></tr></table>
			<?php 			
			$filename=$f.".json";
		    if(!file_exists($filename)){
			    makenewfile($filename);
		    }

		    $fp=fopen($filename,"w");
		    fwrite($fp,$string);
		    fclose($fp);        
        }		
        exit;
    }	
}

$aa=new stock;



?>