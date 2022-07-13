/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready( 
    function(){
	$('#eventos').animatedinnerfade({ 
	    speed: 'slow',
	    timeout: 6000,
	    type: 'sequence',
	    animationtype: 'fade',
	    controlBoxClass: 'mycontrolboxclass',
	    containerheight: '280px',
	    containerwidth: '360px',
	    controlBox: 'show',
	    controlButtonsPath: '../php-scripts/scripts/jquery.animated.innerfade/img'
	});
	
	$("#noticias").mouseover(function(){
	    $("#noticias").removeClass("sinScroll");
	    $("#noticias").addClass("scroll");
	});

	$("#noticias").mouseout(function(){
	    $("#noticias").removeClass("scroll");
	    $("#noticias").addClass("sinScroll");
	});
    });
    