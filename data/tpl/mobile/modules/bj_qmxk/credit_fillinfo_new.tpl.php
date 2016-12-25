<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template('header', TEMPLATE_INCLUDEPATH);?>
<link type="text/css" rel="stylesheet" href="<?php echo BJ_QMXK_ROOT;?>/recouse/credit/base.css" />
<link type="text/css" rel="stylesheet" href="<?php echo BJ_QMXK_ROOT;?>/recouse/credit/style.css?v=1" />
         <script type="text/javascript" src="<?php echo BJ_QMXK_ROOT;?>/recouse/credit/script.js"></script>
<title>兑奖信息</title>
	<section class="reserve">
    	<!--content-->
        <section class="reserve_content">
        	<!--title-->
            <p class="reserve_title"><span style="color:#000">请认真填写以下信息</span></p>
            <!--tielt end-->
            <!--details-->
            <section class="reserve_details">
			<?php  foreach(explode("-",$award_info['title']) as $v) echo "<p>" . $v . "</p>"; ?>
            </section>
            <!--details end-->
			<!--data-->
			<section class="reserve_data">

			<form action="" method="post" data-ajax="false" onsubmit="return check(this)">
				<input name="id" type="hidden" id="id" value="<?php  echo $award_list['award_id'];?>" />
				<input name="act" type="hidden"  value="module">
				<input name="name" type="hidden"   value="bj_qmxk">
				<input name="do" type="hidden"  value="credit">
				<input name="weid" type="hidden"  value="<?php  echo $_W['weid'];?>">
				<section class="data_box">
				<label class="data_box_l">真实姓名</label>
				<span class="data_box_r"><input type="text" name="realname" value="<?php  echo $profile['realname'];?>" placeholder="请输入您的真实姓名" class="txt" /></span>
				</section>
                <section class="data_box">
                    	<label class="data_box_l">联系电话</label>
						<span class="data_box_r"><input name="mobile" type="text" value="<?php  echo $profile['mobile'];?>" placeholder="请输入您的手机" class="txt" /></span>
				</section>
                 <section class="data_box">
                    	<label class="data_box_l">邮寄地址</label>
						<span class="data_box_r"><input name="residedist" type="text" value="<?php  echo $profile['residedist'];?>" placeholder="请输入您的邮寄地址" class="txt" /></span>
				</section>
              
                    <!--btn-->
                    <section class="reserve_btn_box">
                        <input type="submit" value="提交登记" class="reserve_btn" />
                    </section>
                    <!--btn end-->
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </form>
            </section>
            <!--data end-->
        </section>
        <!--content end-->
		</section>

		<script type="text/javascript">
			function check(form) {
				if (!form['realname'].value) {
					alert('请输入您的真实姓名！');
					return false;
				}
				if (!form['mobile'].value) {
					alert('请输入您的手机号码！');
					return false;
				}
				if (!/^1[0-9]{10}/.test(form['mobile'].value)) {
					alert('请输入正确的手机号码！');
					return false;
				}
				if (!form['residedist'].value) {
					alert('请输入您的邮寄地址！');
					return false;
				}
				return true;
			}
		</script>

		<?php  include $this->template('footer', TEMPLATE_INCLUDEPATH);?>
<?php  include $this->template('jsweixin', TEMPLATE_INCLUDEPATH);?>
