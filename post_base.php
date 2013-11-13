<?php include "base.php" ?>

<!-- Title block --> 
<?php startblock('title') ?>
	Post View
<?php endblock() ?>

<?php startblock('content') ?>
	
	//Here be the title of the post
	<h3 id ='title-request'> </h3>

	//Here be the language of the post
	<div id='language-request'><p> </p></div>
	
	
	//Here be the description of the post
	<div id = 'description-request'> <p> </p></div>
	
	
	//Here be the list of replies
	
<!-- DISQUS COMMENTS -->	
<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'paidsource'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>

<?php endblock() ?>
