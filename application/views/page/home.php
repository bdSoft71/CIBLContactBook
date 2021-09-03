<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>my/myStyle.css">


	<title>Contact Book</title>
</head>
<body>
<!-- <div id="p" class="easyui-panel" style="width:550px;height:250px;padding:10px;"
        title="My Panel" data-options="iconCls:'icon-save',collapsible:true"> -->
    <table id="dg" title="My Contact" class="easyui-datagrid" style="width:auto;height:auto"
        url="<?php echo base_url().'ContactController/getContact'; ?>"
        toolbar="#toolbar" pagination="true"
        rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="name" width="50">Full Name</th>
            <th field="phone" width="50">Phone</th>
            <th field="company" width="50">Company</th>
            <th field="address" width="50">Address</th>
        </tr>
    </thead>
</table>
<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newContact()">New</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editContact()">Edit</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyContact()">Remove</a>
    <span>Name:</span>
    <input id="nameid" style="line-height:26px;border:1px solid #ccc">
    <span>Phone:</span>
    <input id="phoneid" style="line-height:26px;border:1px solid #ccc">
    <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>
   <!--  <br>
    From:<input id="dd1" type="text" class="easyui-datebox">
    To:<input id="dd2" type="text" class="easyui-datebox">
    <a href="#" class="easyui-linkbutton" plain="true" onclick="dateSearch()">Filter</a> -->
</div>
<!-- </div> -->

<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:15px 25px"
        closed="true" buttons="#dlg-buttons">
    <div class="ftitle">Contact Information</div>
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <label>Full Name:</label>
            <input name="name" class="easyui-textbox" required="true">
        </div>
        <div class="fitem">
            <label>Company:</label>
            <input name="company" class="easyui-textbox">
        </div>
        <div class="fitem">
            <label>Phone:</label>
            <input name="phone" class="easyui-textbox" required="true">
        </div>
        
        <div class="fitem">
            <label>Address:</label>
            <textarea name="address"></textarea>
        </div>
    </form>
</div>
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveContact()" style="width:90px">Save</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
</div>

<!-- <script type="text/javascript" src="<?php echo base_url(); ?>my/myScript.js"></script> -->
<script type="text/javascript">

   
    var url;
function newContact(){
    $('#dlg').dialog('open').dialog('setTitle','New Contact');
    $('#fm').form('clear');
    url = '<?php echo base_url(); ?>ContactController/saveContact';
}


function editContact(){
var row = $('#dg').datagrid('getSelected');
if (row){
    $('#dlg').dialog('open').dialog('setTitle','Edit Contact');
    $('#fm').form('load',row);
    url = '<?php echo base_url(); ?>ContactController/updateContact/'+row.contact_info_id;
}
}


function saveContact(){
    $('#fm').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.errorMsg){
                $.messager.show({
                    title: 'Error',
                    msg: result.errorMsg
                });
            } else {
                $('#dlg').dialog('close');        // close the dialog
                $('#dg').datagrid('reload');    // reload the user data
                $.messager.show({
                    title: 'Success',
                    msg: result.success
                });
            }
        }
    });
}


function destroyContact(){
    var row = $('#dg').datagrid('getSelected');
    
    if (row){
        $.messager.confirm('Confirm','Are you sure you want to destroy this profile?',function(r){
            if (r){
                var urlD='<?php echo base_url(); ?>ContactController/destroyContact/';
                $.post(urlD,{id:row.contact_info_id},function(result){
                    if (result.success){
                        $('#dg').datagrid('reload');    // reload the user data
                        $.messager.show({
                    title: 'Success',
                    msg: result.success
                });
                    } else {
                        $.messager.show({    // show error message
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    }
                },'json');
            }
        });
    }
}

function doSearch(){
    var nameid= $('#nameid').val();
    var phoneid= $('#phoneid').val();
    var urlS;
    if(nameid && !phoneid){
     urlS='<?php echo base_url(); ?>ContactController/searchNameContact/'+nameid;
    }else if(phoneid && !nameid){
    urlS='<?php echo base_url(); ?>ContactController/searchPhoneContact/'+phoneid;
}else if(nameid && phoneid ){
    urlS='<?php echo base_url(); ?>ContactController/searchContact/'+nameid+'/'+phoneid;
}else{
    urlS='<?php echo base_url(); ?>ContactController/getContact';
}
      //alert(urlS);
      $('#dg').datagrid({
    url:urlS
});
    
}
/*function dateSearch(){

    var vFrom = $('#dd1').datebox('getValue');
    var vTo = $('#dd2').datebox('getValue');
    var urlD='<?php echo base_url(); ?>ContactController/searchDateContact';

    alert(vFrom);
    alert(vTo);
    $.ajax({
        url:urlD,
        method:'POST',
        data:{vFrom:vFrom,vTo:vTo},
        success:function(data){
            $('#dg').datagrid({
    data:data
});
        }
    });

     $('#dg').datagrid({
    url:urlD
});
    
}*/
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>

</body>
</html>