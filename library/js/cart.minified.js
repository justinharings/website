function submitCallme()
{$("#phone_number").removeAttr("style");if($("#phone_number").val()!="")
{$('form#callback').submit()}
else{$("#phone_number").css("background-color","#f5ecec").css("border-color","#d00000")}}
$(document).ready(function($)
{$(".export-fee").hide();$("select#country").on("change",function()
{$(".export-fee").hide();if($(this).val()!="Netherlands")
{var country=$(this).val();country=country.replace(" ","_");if($("input.fee_"+country).length>0)
{var fee=$("input.fee_"+country).val();$(".export-fee").show();$(".export-fee").find(".amount").html(fee)}
else if($("input.fee_Overige_landen").length>0)
{var fee=$("input.fee_Overige_landen").val();$(".export-fee").show();$(".export-fee").find(".amount").html(fee)}}});if($("select#country").val()!="")
{$("select#country").trigger("change")}
$("form#book").find("input[type='submit']").on("click",function(e)
{e.preventDefault();var button=$("#book_order");button.attr("text",button.val()).val("One moment please ...");var valid=!0;$("input[req], select[req]").removeAttr("style");$("input[req], select[req]").each(function()
{if($(this).val()=="")
{$(this).css("border-color","#d00000");valid=!1}
else if($(this).attr("req")=="email")
{var re=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;if(!re.test($(this).val()))
{$(this).css("border-color","#d00000");valid=!1}}});if(valid==!0)
{$(this).closest("form").submit()}
else{button.val(button.attr("text"))}});$("div.cart-info").find("div.button").on("click",function()
{var elm=$(this);var txt=elm.html();elm.html("loading . . .");$.post("/library/php/posts/cart.php",{productID:elm.attr("productid"),addonID:elm.attr("addonid")}).done(function(data)
{$("div.cart-count").html(data);$("div.search-field").fadeOut("fast");elm.html(txt);$("body, html").animate({scrollTop:0},500,function()
{$("div.cart-notification").fadeIn("fast").css("display","table")})})});$("div.button.light").on("click",function()
{$("div.cart-notification, div.search-field").fadeOut("fast")});$("select#quantity").on("change",function()
{$(this).closest("form").submit()});$("ul.checkout-choices").find("li:not(.extra-field)").on("click",function()
{var input=$(this).closest("ul").attr("inputname");$("input#"+input).val($(this).attr("id"));$(this).closest("ul").find("div.choice").find("span").removeClass("fa-check active").addClass("fa-circle");$(this).find("div.choice").find("span").removeClass("fa-circle").addClass("fa-check active");$(this).closest("ul").find("li.extra-field").removeClass("active").find("input").removeAttr("req");$(this).closest("ul").find("li.extra-field.extra-"+$(this).attr("id")).addClass("active").find("input").attr("req","text")});$("ul.checkout-choices").find("li").find("div.choice").find("span.active").closest("li").trigger("click")})