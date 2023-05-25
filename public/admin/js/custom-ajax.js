/*
* MAANNEWS CUSTOM AJAX
 * ------------------
 * You should not use this file in production.
* */
"use strict";
$(document).ready(function(){
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]') } });
// news category
    $("#newscategory_id").on("change",function (){

        var newscategory_id = $('#newscategory_id').val();
        $('#newssubcategory_id').empty();
        $.ajax({
            url:config.routes.newscategory,
            method:"get",
            dataType:"json",
            data:{
                'newscategory_id':newscategory_id,
            },
            success: function(data){

                $.each(data,function (index,element){
                    $("#newssubcategory_id").append(
                    '<option value="'+element.id+'">'+element.name+'</option>'
                );
            });
            },
            error: function () {
                alert('Error occur fetch subcategory action.....!!');
            }

        })
    });
    // blog sub-category
    $("#blogcategory_id").on("change",function (){

        var blogcategory_id = $('#blogcategory_id').val();
        $('#blogsubcategory_id').empty();
        $.ajax({
            url:config.routes.blogcategory,
            method:"get",
            dataType:"json",
            data:{
                'blogcategory_id':blogcategory_id,
            },
            success: function(data){

                $.each(data,function (index,element){
                    $("#blogsubcategory_id").append(
                    '<option value="'+element.id+'">'+element.name+'</option>'
                );
            });
            },
            error: function () {
                alert('Error occur fetch subcategory action.....!!');
            }

        })
    });
// video gallery ..

    var video_option = $('#video_option').val();
    if (video_option=='Upload Video'){

        $("#videosorucediv,#linkdiv").hide();
        $("#videodiv").show();
    }else if(video_option=='Share Link'){
        $("#videodiv").hide();
        $("#videosorucediv,#linkdiv").show();
    }else{
        $("#videosorucediv,#linkdiv,#videodiv").hide();
    }

    $("#video_option").on("change",function (){
        var video_option = $('#video_option').val();
        if (video_option=='Upload Video'){
            $("#videosorucediv,#linkdiv").hide();
            $("#videodiv").show();
        }else if(video_option=='Share Link'){
            $("#videodiv").hide();
            $("#videosorucediv,#linkdiv").show();
        }else{
            $("#videosorucediv,#linkdiv,#videodiv").hide();

        }
    });

    //user
    var permissions_box = $("#permissions_box");
    var permissions_checkbox_list = $("#permissions_checkbox_list");

    permissions_box.hide()//hide permission box

    $("#role").on("change",function (){
        var role = $(this).find(":selected");
        var role_id = role.data("role-id");
        permissions_checkbox_list.empty();

        $.ajax({
            url:"create",
            method:"GET",
            dataType:"json",
            data:{
                role_id:role_id,

            }

        }).done(function (data){
            //show permission box
            permissions_box.show();

            $.each(data,function (index,element){
                $(permissions_checkbox_list).append(
                    '<div class="form-group">'+

                    '<input type="checkbox" class="custom-control-input" name="permissions[]" id="'+element.slug+'" value="'+element.id+'" checked="checked" >'+
                    '<label class="custom-control-label" for="'+element.slug+'">'+element.name+'</label>'+
                    '</div>'
                )
            });
        });
    });

    //user edit
    var user_permissions_box = $("#user_permissions_box");
    permissions_box.hide()//hide permissions box

    $("#roleedit").on("change",function (){
        var role = $(this).find(":selected");
        var role_id = role.data("role-id");
        permissions_checkbox_list.empty();
        user_permissions_box.empty();

        $.ajax({
            url:config.routes.userrole,
            method:"get",
            dataType:"json",
            data:{
                role_id:role_id,

            }
        }).done(function (data){

            permissions_box.show();
            $.each(data,function (index,element){
                $(permissions_checkbox_list).append(
                    '<div class="form-group">'+

                    '<input type="checkbox" class="custom-control-input" name="permissions[]" id="'+element.slug+'" value="'+element.id+'" checked="checked" >'+
                    '<label class="custom-control-label" for="'+element.slug+'">'+element.name+'</label>'+
                    '</div>'
                )
            });
        });
    });


});
/** =====================**
 * blog published
 * blog unpublished
 **=======================*/
$('.status-item').each(function () {
    var container = $(this);
    var service = container.data('id');
    //publish unpublish
    $('#menu_publish_'+service).on('click',function () {
        var id = $('#menu_publish_'+service).data('id');
        var statustext = $('#menu_publish_'+service).data('status-text');
        if ($('#menu_publish_'+service).is(":checked"))
        {
            var status = 1
        }else {
            var status = 0
        }
        //call ajax function
        ajaxFunction(id,statustext,status);

    })
    //publish unpublish
    $('#status_'+service).on('click',function () {
        var id = $('#status_'+service).data('id');
        var statustext = $('#status_'+service).data('status-text');

        if ($('#status_'+service).is(":checked"))
        {
            var status = 1
        }else {
            var status = 0
        }

        //call ajax function
       ajaxFunction(id,statustext,status);
    });
    $('#breakingnews_'+service).on('click',function () {
        var id = $('#breakingnews_'+service).data('idbreaking');
        var statustext = $('#breakingnews_'+service).data('status-textbreaking');

        if ($('#breakingnews_'+service).is(":checked"))
        {
            var status = 1
        }else {
            var status = 0
        }
        //call ajax function
       ajaxFunction(id,statustext,status);

    });
    //contact us
    $('#contactus_'+service).on('click',function () {

        var id = $('#contactus_'+service).data('idcontactus');
        var statustext = $('#contactus_'+service).data('status-textcontactus');
        if ($('#contactus_'+service).is(":checked"))
        {
            var status = 1
        }else {
            var status = 0
        }
        //call ajax function
       ajaxFunction(id,statustext,status);

    });
});
function ajaxFunction(id,statustext,status){

    $.ajax({
        url:'/admin/publish/status/ajax',
        method:"GET",
        dataType:"json",
        data:{
            'status':status,'id':id,'statustext':statustext,
        },
        success: function(data){
            if(data.status==1){
                toastr.success(statustext+' Published');
            }else{
                toastr.error(statustext+' Unpublished.');
            }
        },
        error: function (data) {
            console.log(data)
            alert(data);
            //alert('Error occur fetch subcategory action.....!!');
        }
    })
}
