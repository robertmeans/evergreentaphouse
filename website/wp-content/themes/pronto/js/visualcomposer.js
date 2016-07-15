!function($) {
$(document).ready(function(){
	$(".search").keyup(function(e){
		e.preventDefault();
		var filter = $(this).val(), count = 0;
		$(".icon-list li").each(function(){
		if ($(this).text().search(new RegExp(filter, "i")) < 0) {
			$(this).fadeOut();
			} else {
			$(this).show();
				count++;
					}
		});
	});
});
		
$(".icon-dropdown li").click(function(e) {
	e.preventDefault();
	$(this).attr("class","selected").siblings().removeAttr("class");
		var icon = $(this).attr("data-icon");
		$(".wpb_vc_param_value.icon").val(icon);
		$(".icon-preview").html("<i class=\'icon fa fa-"+icon+"\'></i>");
});
}(window.jQuery);