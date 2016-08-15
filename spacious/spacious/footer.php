<?php 
/**
 * Theme Footer Section for our theme.
 * 
 * Displays all of the footer section and closing of the #main div.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>


		</div><!-- .inner-wrap -->
	</div><!-- #main -->	
	<?php do_action( 'spacious_before_footer' ); ?>
		<footer id="colophon" class="clearfix">	
			<?php get_sidebar( 'footer' ); ?>	
			<div class="footer-socket-wrapper clearfix">
				<div class="inner-wrap">
					<div class="footer-socket-area">
						<?php
							//session_start();
							if(!isset($_SESSION['visitnum'])){
							//如果没有session才访问数据库来获取访问量，将访问量存在session中
								//链接数据库
								$conn=mysql_connect("localhost","root","19920717");
								if(!$conn){
									die("链接失败".mysql_errno());
								}
								//设置数据库编码方式
								mysql_query("set names utf8",$conn) or die(mysql_errno());
								//选择数据库
								mysql_select_db("visiters",$conn) or die(mysql_errno());
								$adress=$_SERVER["REMOTE_ADDR"];
	 						
	 							$sql="select num from visitinfo where adress='$adress'";
								$res=mysql_query($sql,$conn);
								if(!$row=mysql_fetch_row($res)){
								//查询值为空
								//是首次访问的ip，将ip地址添加到数据库中
								$sql="insert into visitinfo(adress,num) values('$adress',1)";
								$res=mysql_query($sql,$conn);
								}
								else{
								//查询到有记录，则不是首次访问的ip，num数+1
									$sql="UPDATE visitinfo SET num= num+1 WHERE adress= '$adress' ";
									$res=mysql_query($sql,$conn);
								}
								//发送语句获取总数
								$sql="select sum(num) from visitinfo";
								$res=mysql_query($sql,$conn);
								if($row=mysql_fetch_row($res)){
									$_SESSION['visitnum']=$row['0']; 
								}
							}

							$color="#0FBE7C";
							$size="0";
							echo "<font color=".$color." size=".$size.">";
							echo"您是第 ".$_SESSION['visitnum']." 位访客</br>"."您的ip地址是". $_SERVER["REMOTE_ADDR"];
							echo "</font>";
						?>
						<nav class="small-menu clearfix">		
							<ul>
								<li>
									<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=763811941&site=qq&menu=yes">QQ联络</a>
								</li>
								<li>
									<a href="mailto:cvvz@ftd-chenwz.com">cvvz@ftd-chenwz.com</a>
								</li>
							</ul>
		    			</nav>
					</div>
				</div>
			</div>			
		</footer>
		<a href="#masthead" id="scroll-up"></a>	
	</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>