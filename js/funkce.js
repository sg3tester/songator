/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready( function() {
    
	$(".reason").click(function(){
	    $("#reason").val($(this).text());
	    return false;
	});

        // confirmator

        $('a[data-confirm], button[data-confirm], input[data-confirm]').live('click', function (e) {
                 if (!confirm($(this).attr('data-confirm'))) {
                         e.preventDefault();
                         e.stopImmediatePropagation();
                         return false;
                 }
         });
	 
	 //Bookmark highlighter
	 
	 var url = $(location).attr('href');
	 var mark = url.split("#")[1];
	 $("#"+mark).addClass("marked").delay(3000).fadeOut(function(){
	     $("#"+mark).removeClass("marked").fadeIn();
	 });
	 
	 //Verified sign
	 $(".verified").hide();
	 $("tr").mouseenter(function(){
	     $(this).children("td").children(".verified").show();
	 });
	 $("tr").mouseleave(function(){
	     $(this).children("td").children(".verified").hide();
	 });
	 
});
