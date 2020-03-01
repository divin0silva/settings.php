<form action = "index.php?p=settings" method = "post">

<div id = "sub-head">
	<button type = "submit"><?php echo $lang_blog_button_update; ?></button>
	<?php greenCheckmark();?>
</div>

<div id = "content">

<?php
require_once("login.php");

if ($_POST["status"] == 1) {		

     if (isset($_SESSION["token"]) 
        && isset($_SESSION["token_time"]) 
        && isset($_POST["token"]) 
        && $_SESSION["token"] == $_POST["token"]) {
        
        $timestamp_old = time() - (60*60);

        if ($_SESSION["token_time"] >= $timestamp_old) {
	   
	        foreach ($_POST as $var => $key) {
                $$var = htmlspecialchars(trim(stripslashes($key)), ENT_QUOTES, "UTF-8");
            }

	        $config = '<?php    
$pulse_dir = "'. $directory .'";
$page_title = "'. $page_title .'";
$page_desc = "'. $page_desc .'";
$logo_url = "'. $logo_url .'";
$pulse_pass = "'. $password .'";
$height = "'. $height .'";
$width = "'. $width .'";
$blog_url = "'. $blog_url .'";
$analytics_id = "'. $analytics_id .'";
$stream_ip = "'. $stream_ip .'";
$stream_port = "'. $stream_port .'";
$xat_nome = "'. $xat_nome .'";
$xat_id = "'. $xat_id .'";
$per_page = "'. $posts_per .'";
$blog_comments = '. $comments .';
$blog_capcha = '. $blog_capcha .';
$date_format = "'. $date_format .'";
$email_contact = "'. $email .'";
$pulse_lang = "'. $pulse_lang .'";
$anun_nome_1 = "'. $anun_nome_1 .'";
$anun_nome_2 = "'. $anun_nome_2 .'";
$anun_nome_3 = "'. $anun_nome_3 .'";
$anun_nome_4 = "'. $anun_nome_4 .'";
$anun_banner_1 = "'. $anun_banner_1 .'";
$anun_banner_2 = "'. $anun_banner_2 .'";
$anun_banner_3 = "'. $anun_banner_3 .'";
$anun_banner_4 = "'. $anun_banner_4 .'";
$anun_link_1 = "'. $anun_link_1 .'";
$anun_link_2 = "'. $anun_link_2 .'";
$anun_link_3 = "'. $anun_link_3 .'";
$anun_link_4 = "'. $anun_link_4 .'";
$fb_url = "'. $fb_url .'";
$tw_url = "'. $tw_url .'";
$custom_fieldname1 = "'. $custom_fieldname1 .'";
$custom_fieldname2 = "'. $custom_fieldname2 .'";
$formcap = "'. $formcap .'";
$startpage = "'. $startpage .'";

?>';

            if ($fp = fopen("../config.php", "w")) {
                fwrite($fp, $config, strlen($config));
                
                $_SESSION["saved"]=true;
                $host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				header("Location: //$host$uri/index.php?p=settings");
				die();
				
            } else {
                echo "<p class=\"errorMsg\">$lang_settings_unwritable</p>"; 
            }
        }       
    }
}

if (empty($_SESSION["token"]) || $_SESSION["token_time"] <= $timestamp_old){
		 $_SESSION["token"]      = md5(uniqid(rand(), TRUE));	
		 $_SESSION["token_time"] = time();
}

if (!isset($_POST["status"])) {
?>
    
    
 <style>

.accordion {
  padding: 0;
  margin: 2em 0;
  width: 100%;
  overflow: hidden;
  font-size: 1em;
  position: relative;
}

.accordion__title {
  padding: 0 1em;
  background: #ccc;
  border-top: 2px solid #eee;
  color: #222;
  float: left;
  line-height: 3;
  height: 3em;
  cursor: pointer;
  margin-right: .25em;
}

.no-js .accordion__title {
  float: none;
  height:auto;
  cursor:auto;
  margin:0;
  padding:0 2em;
}

.accordion__content {
  float: right;
  width: 100%;
  margin: 3em 0 0 -100%;
  padding: 0;
  background: fff;
}

.no-js .accordion__content {
  float:left;
  margin:0;
}

.accordion__title:hover,
.accordion__title.active {
  background: silver;
  color: white;
}

.no-js .accordion__title:hover {
  background-color:#ccc;
  color:#222;
}

.accordion__title.active {
  border-top-color:lime;
}

@media (max-width: 48em) {
  
  .accordion {
    border: 1px solid grey;
  }
  
  .accordion__title,
  .accordion__content { 
    float: none;
    margin: 0;
  }
  
  .accordion__title:first-child {
    border:none;
  }
  
 .accordion__title.active {
  border-top-color:#eee;
  }
  
  .accordion__title.active, .accordion__title:hover {
    background:#777;
  }
  
  .accordion__title:before {
  content:"+";
  text-align:center;
  width:2em;
  display:inline-block;
  }
 .accordion__title.active:before {
  content:"-";
  }
  
 .overflow-scrolling {
  overflow-y: scroll;
  height:11em;
  padding:1em 1em 0 1em;
  /* Warning: momemtum scrolling seems buggy on iOS 7  */
  -webkit-overflow-scrolling: touch;
  }

  .accordion__content {
    position:relative;
    overflow:hidden;
    padding:0;
  }
  
   .no-js .accordion__content {
    padding:1em;
    overflow:auto;
    display:block;
  }
  
  .accordion__content:after {
    position:absolute;
    top:100%;
    left:0;
    width:100%;
    height:50px;
    border-radius:10px 0 0 10px / 50% 0 0 50%;
    box-shadow:-5px 0 10px rgba(0, 0, 0, 0.5);
    content:'';
}
   
}
</style>   
    
    <dl class="accordion">
    
      <dt class="accordion__title">Geral</dt>
  <dd class="accordion__content">
<div class="settings">
   <br>
   <h2><?php echo $lang_setting_general; ?></h2>
   
   <div class="setting">
	   <label><?php echo $lang_setting_folder; ?></label>
	   <input class="med" type="text" name="directory" value="<?php echo $pulse_dir; ?>"/>
	   <p class="settings-hints"><?php echo $lang_setting_folder_hint; ?></p>
   </div>
     
 
   
   <div class="setting">
	    <label>Título do Site</label>
	    <input class="long "type="text" name="page_title" value="<?php echo $page_title; ?>" />
    </div>

    
    
       <div class="setting">
	    <label>Descrição do Site</label>
	    <input class="long "type="text" name="page_desc" value="<?php echo $page_desc; ?>" />
    </div>
    
           <div class="setting">
	    <label>Url da logo</label>
	    <input class="long "type="text" name="logo_url" value="<?php echo $logo_url; ?>" />
    </div>
   
   <div class="setting">
	   <label><?php echo $lang_setting_password; ?></label>
	   <input class="med" type="password" name="password" value="<?php echo $pulse_pass; ?>"/>
   </div>
   
   <div class="setting">
	   <label><?php echo $lang_email_contact; ?></label>
	   <input class="med" type="text" name="email" value="<?php echo $email_contact; ?>"/>
   </div>
   
   <div class="setting">
	   <label><?php echo $lang_setting_lang; ?></label>
	   <select name="pulse_lang">
	   
	   <?php 	   
	   foreach ((glob("includes/lang/*")) as $language) {
		   $language = explode("/", $language);
		   $language = explode(".", $language[2]);	
		   $language_collection[] = $language[0];
		 }

		foreach($language_collection as $lang_option){

		?><option value = "<?php echo $lang_option; ?>"<?php echo $pulse_lang == $lang_option ? 'selected="selected"' : '';?>><?php echo ucfirst($lang_option); ?></option><?php
		   			   		
			  } ?>
	   
	   </select> 
   </div>
   
      <div class="setting">
	   <label><?php echo $lang_blocks_home; ?></label>
	   <select name="startpage">
	   
	   <?php 	
	   $startpage_options = array(
	   		array($lang_nav_pages,'manage-pages'), 
	   		array($lang_nav_blocks,'manage-blocks'), 
	   		array($lang_nav_blog,'manage-blog'), 
	   		array($lang_nav_galleries,'manage-gallery'), 
	   		array($lang_nav_form,'manage-form'), 
	   		array($lang_nav_stats,'manage-stats'), 
	   		array($lang_nav_backup,'manage-backups'), 
	   		array($lang_nav_settings,'settings') 
	   		);
	      
	   foreach ($startpage_options as $startpage_option) {

		?><option value = "<?php echo $startpage_option[1]; ?>"<?php echo $startpage == $startpage_option[1] ? 'selected="selected"' : '';?>><?php echo ucfirst($startpage_option[0]); ?></option><?php
		   			   		
			  } ?>
	   
	   </select> 
   </div>
</dd>

      <dt class="accordion__title">Extras</dt>
  <dd class="accordion__content">
    <br>
    <h2>Extras</h2>

     <div class="setting">
     
             <div class="setting">
	   <label>Facebook</label>
	   <input class="long" type="text" name="fb_url" value="<?php echo $fb_url; ?>"/>
	   <p class="settings-hints">Coloque página do Facebook Exemplo: facebook.com/nomepagina coloque somente o que está no final "facebook.com/"    exemplo: "nomepagina"  sem aspas.</p>
   </div>
   
                <div class="setting">
	   <label>Twitter</label>
	   <input class="long" type="text" name="tw_url" value="<?php echo $tw_url; ?>"/>
	   <p class="settings-hints">Coloque o usuário do Twitter.</p>
   </div>
   
        <div class="setting">
	   <label>Analytics ID</label>
	   <input class="long" type="text" name="analytics_id" value="<?php echo $analytics_id; ?>"/>
	   <p class="settings-hints">Coloque o ID do Google Analytics</p>
   </div>
  
  </dd>


      <dt class="accordion__title">Galeria</dt>
  <dd class="accordion__content">
  <br>
    <h2><?php echo $lang_setting_gallery_thumbnails; ?></h2>
    
    <div class="setting">
    	<span><?php echo $lang_setting_tim_height; ?></span>
    	<input name="height" type="text" style="width:75px" placeholder="100" value="<?php echo $height; ?>" >
    	<span><?php echo $lang_setting_tim_width; ?></span>
    	<input name="width" type="text" style="width:75px" placeholder="100" value="<?php echo $width; ?>" >
    </div>
       </dd>
       

          <dt class="accordion__title">Blog</dt>
  <dd class="accordion__content">
  <br>
    <h2><?php echo $lang_setting_blog; ?></h2>
    
    <div class="setting">
	    <label><?php echo $lang_setting_blog_url; ?></label>
	    <input class="long "type="text" name="blog_url" value="<?php echo $blog_url; ?>" />
	    <p class="settings-hints"></p>
    </div>
    
    <div class="setting">
	    <label><?php echo $lang_setting_blog_posts; ?></label>
	    <input type="text" name="posts_per" value="<?php echo empty($per_page) ? 5 : $per_page; ?>" />
    </div>
    
    <div class="setting">
    <?php if( ($date_format == '0') || ($date_format == '1')){ $date_format = 'd-m-Y';}?>
	    <label ><?php echo $lang_setting_date; ?></label>
		<input type="text" name="date_format" value="<?php echo $date_format; ?>"/>
		<p class="settings-hints"><?php echo $lang_setting_blog_date; ?></p>
    </div>
    
    <div class="setting">
	    <label><?php echo $lang_setting_blog_comments; ?></label>
	    <select name="comments">
	    	<option value="true" <?php echo ($blog_comments) ? 'selected="selected"' : '';?>><?php echo $lang_setting_blog_enabled; ?></option>
	    	<option value="false" <?php echo ($blog_comments) ? '' : 'selected="selected"';?>><?php echo $lang_setting_blog_disabled; ?></option>
	    </select>
    </div>
    
    <div class="setting">
	    <label><?php echo $lang_blog_capcha ?></label>
	    <select name="blog_capcha">
	    	<?php if (!isset ($blog_capcha)) { $blog_capcha = true; } ?>
	    	<option value="true" <?php echo ($blog_capcha) ? 'selected="selected"' : '';?>><?php echo $lang_setting_blog_enabled; ?></option>
	    	<option value="false" <?php echo ($blog_capcha) ? '' : 'selected="selected"';?>><?php echo $lang_setting_blog_disabled; ?></option>
	    </select>
    </div>   
</dd>

          <dt class="accordion__title">Streaming</dt>
  <dd class="accordion__content">
     <br>
      <h2>Configuração do Streaming</h2>
   
        <div class="setting">
	   <label>Stream Ip:</label>
	   <input class="long" type="text" name="stream_ip" value="<?php echo $stream_ip; ?>"/>
	   <p class="settings-hints">Coloque o ip do stream exemplo: 127.0.0.1</p>
   </div>
   
           <div class="setting">
	   <label>Stream Porta:</label>
	   <input class="long" type="text" name="stream_port" value="<?php echo $stream_port; ?>"/>
	   <p class="settings-hints">Coloque a porta do stream. Exemplo SHOUTcast "1454/;" sem aspas. Exemplo icecast "1454/live" sem aspas.</p>
   </div>
   
    </dd>

    <!-- xat -->
<dt class="accordion__title">Bat Papo</dt>
  <dd class="accordion__content">
     <br>
      <h2>Configuração do xat.com</h2>
   
        <div class="setting">
     <label>Nome do xat:</label>
     <input class="long" type="text" name="xat_nome" value="<?php echo $xat_nome; ?>"/>
     <p class="settings-hints">Coloque o ip do stream exemplo: 127.0.0.1</p>
   </div>
   
        <div class="setting">
     <label>Id do xat:</label>
     <input class="long" type="text" name="xat_id" value="<?php echo $xat_id; ?>"/>
     <p class="settings-hints">Coloque a porta do stream. Exemplo SHOUTcast "1454/;" sem aspas. Exemplo icecast "1454/live" sem aspas.</p>
   </div>
   
    </dd>
<!-- xat -->

    
              <dt class="accordion__title">Anúncios</dt>
  <dd class="accordion__content">
     <br>
      <h2>Anunciante 1</h2>
   
        <div class="setting">
	   <label>Nome:</label>
	   <input class="long" type="text" name="anun_nome_1" value="<?php echo $anun_nome_1; ?>"/>
       <label>URl do Banner:</label>
	   <input class="long" type="text" name="anun_banner_1" value="<?php echo $anun_banner_1; ?>"/>
       <label>Link:</label>
	   <input class="long" type="text" name="anun_link_1" value="<?php echo $anun_link_1; ?>"/>
   </div>
   <h2>Anunciante 2</h2>
   
        <div class="setting">
	   <label>Nome:</label>
	   <input class="long" type="text" name="anun_nome_2" value="<?php echo $anun_nome_2; ?>"/>
       <label>URl do Banner:</label>
	   <input class="long" type="text" name="anun_banner_2" value="<?php echo $anun_banner_2; ?>"/>
       <label>Link:</label>
	   <input class="long" type="text" name="anun_link_2" value="<?php echo $anun_link_2; ?>"/>
   </div>
      <h2>Anunciante 3</h2>
   
        <div class="setting">
	   <label>Nome:</label>
	   <input class="long" type="text" name="anun_nome_3" value="<?php echo $anun_nome_3; ?>"/>
       <label>URl do Banner:</label>
	   <input class="long" type="text" name="anun_banner_3" value="<?php echo $anun_banner_3; ?>"/>
       <label>Link:</label>
	   <input class="long" type="text" name="anun_link_3" value="<?php echo $anun_link_3; ?>"/>
   </div>
      <h2>Anunciante 4</h2>
   
        <div class="setting">
	   <label>Nome:</label>
	   <input class="long" type="text" name="anun_nome_4" value="<?php echo $anun_nome_4; ?>"/>
       <label>URl do Banner:</label>
	   <input class="long" type="text" name="anun_banner_4" value="<?php echo $anun_banner_4; ?>"/>
       <label>Link:</label>
	   <input class="long" type="text" name="anun_link_4" value="<?php echo $anun_link_4; ?>"/>
   </div>
          
   
    </dd>
    
    </dl>
    

    <input name="custom_fieldname1" type="hidden" value="<?php echo $custom_fieldname1; ?>" >
    <input name="custom_fieldname2" type="hidden" value="<?php echo $custom_fieldname2; ?>" >
    <input name="formcap" type="hidden" value = "<?php echo $formcap; ?> ">
       
    <input type="hidden" name="status" value="1" />
    <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>" />
    
    </form>

        <script>
if($(window).width() > 768){

// Hide all but first tab content on larger viewports
$('.accordion__content:not(:first)').hide();

// Activate first tab
$('.accordion__title:first-child').addClass('active');

} else {
  
// Hide all content items on narrow viewports
$('.accordion__content').hide();
};

// Wrap a div around content to create a scrolling container which we're going to use on narrow viewports
$( ".accordion__content" ).wrapInner( "<div class='overflow-scrolling'></div>" );

// The clicking action
$('.accordion__title').on('click', function() {
$('.accordion__content').hide();
$(this).next().show().prev().addClass('active').siblings().removeClass('active');
});
</script>
    
    
<?php } ?>
</div>
</div>