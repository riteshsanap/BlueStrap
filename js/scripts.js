// DOM Ready
jQuery(document).ready(function ($) {
$('#wp-calendar').addClass('table table-striped');
$('.current-menu-item').addClass('active');
$('#primary article table').addClass('table table-striped table-responsive');
$('.avatar').addClass('thumbnail');
$('a.comment-reply-link').addClass('btn btn-default btn-primary pull-right');
$('p.form-submit #submit').addClass('btn btn-primary btn-lg');
$('a.more-link').addClass('btn btn-primary');
$('div#respond').addClass('well well-default');
$('ul.page-numbers').addClass('pagination');
$('ul.page-numbers .current').parent().addClass('active');
$('.ps-pages a').wrap('<li></li>');
$('.ps-pages>span').wrap('<li class="active"><a></a></li>');
$('nav li.menu-item-has-children>a').append('<span class="glyphicon glyphicon-chevron-down mobico"></span>');
$('.carousel').carousel();
});