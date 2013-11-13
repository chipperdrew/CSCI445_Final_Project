<?php include "base.php" ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Post View
<?php endblock() ?>

<?php startblock('content') ?>
	
	<!-- Here be the title of the post -->
	<h3 id ='title-request'> </h3>

	<!-- Here be the language of the post -->
	<div id='language-request'><p> </p></div>
	
	
	<!-- Here be the description of the post -->
	<div id = 'description-request'> <p> </p></div>
	
	
	<!-- Here be the list of replies -->

	<!-- Intense Debate comments -->

<script>
var idcomments_acct = '649f0b4f2fdb55816123cade693b12fb';
var idcomments_post_id;
var idcomments_post_url;
</script>
<span id="IDCommentsPostTitle" style="display:none"></span>
<script type='text/javascript' src='http://www.intensedebate.com/js/genericCommentWrapperV2.js'></script>


<?php endblock() ?>	
