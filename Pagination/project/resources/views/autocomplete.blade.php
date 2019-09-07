<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
<div class="container">
  <h1>Gagan Autocomplete Mutiple Fields Using jQuery, Ajax and MySQL</h1>
  {!! Form::open() !!}
      
    <table class="table table-bordered">
      <tr>
          <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
          <th>S. No</th>
          <th>Country Name</th>
          <th>Country code</th>
      </tr>
      <tr>
          <td><input type='checkbox' class='chkbox'/></td>
          <td><span id='sn'>1.</span></td>
          <td><input class="form-control autocomplete_txt" type='text' data-type="countryname" id='countryname_1' name='countryname[]'/></td>
          <td><input class="form-control autocomplete_txt" type='text' data-type="country_code" id='country_code_1' name='country_code[]'/> </td>
        </tr>
      </table>
      <button type="button" class='btn btn-danger delete'>- Delete</button>
      <button type="button" class='btn btn-success addbtn'>+ Add More</button>
  {!! Form::close() !!}
</div>
<script type="text/javascript">
          
 $(".delete").on('click', function() {
  $('.chkbox:checkbox:checked').parents("tr").remove();
  $('.check_all').prop("checked", false); 
  updateSerialNo();
});
var i=$('table tr').length;
$(".addbtn").on('click',function(){
  count=$('table tr').length;
  
    var data="<tr><td><input type='checkbox' class='chkbox'/></td>";
      data+="<td><span id='sn"+i+"'>"+count+".</span></td>";
      data+="<td><input class='form-control autocomplete_txt' type='text' data-type='countryname' id='countryname_"+i+"' name='countryname[]'/></td>";
      data+="<td><input class='form-control autocomplete_txt' type='text' data-type='country_code' id='country_code_"+i+"' name='country_code[]'/></td></tr>";
  $('table').append(data);
  i++;
});
        
function select_all() {
  $('input[class=chkbox]:checkbox').each(function(){ 
    if($('input[class=check_all]:checkbox:checked').length == 0){ 
      $(this).prop("checked", false); 
    } else {
      $(this).prop("checked", true); 
    } 
  });
}
function updateSerialNo(){
  obj=$('table tr').find('span');
  $.each( obj, function( key, value ) {
    id=value.id;
    $('#'+id).html(key+1);
  });
}
//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
  type = $(this).data('type');
  
  if(type =='countryname' )autoType='name'; 
  if(type =='country_code' )autoType='sortname'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchajax') }}",
                dataType: "json",
                data: {
                    term : request.term,
                    type : type,
                },
                success: function(data) {
                    var array = $.map(data, function (item) {
                       return {
                           label: item[autoType],
                           value: item[autoType],
                           data : item
                       }
                   });
                    response(array)
                }
            });
       },
       select: function( event, ui ) {
           var data = ui.item.data;           
           id_arr = $(this).attr('id');
           id = id_arr.split("_");
           elementId = id[id.length-1];
           $('#countryname_'+elementId).val(data.name);
           $('#country_code_'+elementId).val(data.sortname);
       }
   });
   
   
});
</script>
</body>
</html>