
$("#markAttendence").click(function() {

  $.ajax({
    url: BASEPATH+'Dashboard/markAttendence',
    type: 'post',
    data: {},
    cache: false,
    success: function(res) {
      var data = JSON.parse(res);
      if(data['responseCode']!='1'){
        toastr.error(data['responseMessage']);
        return false;
      }else{
        toastr.success(data['responseMessage']);
        return true;
      }
    }
  });
   
});


function getDashboardData(){

  $(".tblUsers").DataTable().destroy();
  $("#tblUsersBody").empty();

  var thead = '';
  var thead = '<tr>';
  jQuery.each(usersTablesHeading.alluser, function (i, val) {
      thead += '<td>' + val + '</td>';
  });
  thead += '</tr>';
  $('.tblUsers thead').html(thead);

  $.ajax({
    url: BASEPATH+'Dashboard/getDashboardData',
    type: 'post',
    data: {},
    cache: false,
    success: function(res) {
      
      var data = JSON.parse(res);
      var str = '';
      var j = 1;
      for (var i = 0 ; i < data['userdetails'].length; i++) {
          
          str+="<tr><td>"+j+"</td>";
          str+="<td>"+data['userdetails'][i]['user_name']+"</td>";
          str+="<td>"+data['userdetails'][i]['user_email']+"</td>";
          str+="<td>"+data['userdetails'][i]['gender']+"</td>";

          var status = (data['userdetails'][i]['active']==1) ? 'Active' : 'In-Active';
          var rowClass = (data['userdetails'][i]['active']==1) ? 'label label-success' : 'label label-danger';
          str+="<td><span class='"+rowClass+"'>"+status+"</span></td>";
          
          var userType = (data['userdetails'][i]['status']==1) ? 'Registered' : 'Non-Registered';
          var typeClass = (data['userdetails'][i]['status']==1) ? 'label label-success' : 'label label-warning';
          str+="<td><span class='"+typeClass+"'>"+userType+"</span></td>";

          var btnClass = (data['userdetails'][i]['active']!=1) ? "<span class='label label-info userActive' onclick='activateUser("+data['userdetails'][i]['userid']+")'>Activate</span>" : '<i class="fa fa-check-circle"></i>';
          str+="<td>"+btnClass+"</td>";


          j++;
      }
      
      $("#tblUsersBody").html(str);
      $('.tblUsers').DataTable();

    }
  });


}

function activateUser(id){
    
  $.ajax({
    url: BASEPATH+'Dashboard/activateUser',
    type: 'post',
    data: {user_id : id},
    cache: false,
    success: function(res) {
      console.log(res);
      var data = JSON.parse(res);
      if(data['responseCode']!='1'){
        toastr.error(data['responseMessage']);
      }else{
        toastr.success(data['responseMessage']);
        getDashboardData();
      }
    }
  });

}
