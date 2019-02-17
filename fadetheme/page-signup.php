<?php get_header(); ?>
<article>
<div class="article-content">

<div role="form" class="wpcf7" id="wpcf7-f66-p59-o1" lang="zh-CN" dir="ltr">
<form action="/wordpress/englishpartner/#wpcf7-f66-p59-o1" method="post" class="wpcf7-form" novalidate="novalidate">

<p>
	<label class="label_title"> 昵称：
		<span class="required">*</span><br>
    	<span class="wpcf7-form-control-wrap nickname">
    		<input type="text" name="nickname" value="" size="40" class="wpcf7-form-control nickname" id="nickname" >
    	</span><br>
	</label><br>
	<label class="label_title"> 性别：
		<span class="required">*</span><br>
		<span class="wpcf7-form-control-wrap sex">
			<select name="sex" class="wpcf7-form-control wpcf7-select sex" id="sex">
				<option value="男">男</option>
				<option value="女">女</option>
			</select>
		</span><br>
	</label><br>
	<label class="label_title"> 微信号：
		<span class="required">*</span><br>
    	<span class="wpcf7-form-control-wrap wechat">
    		<input type="text" name="wechat" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required wechat" id="wechat" aria-required="true" aria-invalid="false">
    	</span><br>
	</label><br>
	<label class="label_title"> 英语水平：<span class="required">*</span><br>
    	<span class="wpcf7-form-control-wrap level">
    		<select name="level" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required level" id="level" aria-required="true" aria-invalid="false">
    			<option value="新手">新手</option>
    			<option value="四级">四级</option>
    			<option value="六级">六级</option>
    			<option value="专业">专业</option>
    		</select>
    	</span><br>
	</label><br>
	<label class="label_title"> 学习目的：
		<span class="required">*</span>
	</label><br>
	<span class="wpcf7-form-control-wrap purpose">
		<span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required purpose" id="purpose">
			<span class="wpcf7-list-item first">
				<label>
					<input type="checkbox" name="purpose[]" value="出国旅游">
					<span class="wpcf7-list-item-label">出国旅游</span>
				</label>
			</span>
			<span class="wpcf7-list-item">
				<label>
					<input type="checkbox" name="purpose[]" value="工作需要">
					<span class="wpcf7-list-item-label">工作需要</span>
				</label>
			</span>
			<span class="wpcf7-list-item">
				<label>
					<input type="checkbox" name="purpose[]" value="日常交流">
					<span class="wpcf7-list-item-label">日常交流</span>
				</label>
			</span>
			<span class="wpcf7-list-item">
				<label>
					<input type="checkbox" name="purpose[]" value="提升自我">
					<span class="wpcf7-list-item-label">提升自我</span>
				</label>
			</span>
			<span class="wpcf7-list-item last">
				<label>
					<input type="checkbox" name="purpose[]" value="其他">
					<span class="wpcf7-list-item-label">其他</span>
				</label>
			</span>
		</span>
	</span>
</p>
<p>
	<label class="label_title"> 您的留言<br>
    <span class="wpcf7-form-control-wrap message">
    	<textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea message" id="message" aria-invalid="false" placeholder="留下您想说的，或者建议">
    	</textarea>
    </span><br>
	</label>
</p>
<p><input type="submit" value="发送" class="wpcf7-form-control wpcf7-submit"></p>
<div class="wpcf7-response-output wpcf7-display-none"></div>

</form>
</div>

</div>

</article>
<?php get_footer(); ?>