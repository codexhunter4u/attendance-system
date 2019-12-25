function getUsersDetails(where,heading){

  $(".tblUsers").DataTable().destroy();
  $("#tblUsersBody").empty();
  var columnName = heading;

  var thead = '<tr>';
  var tableHeading = (heading == 'reg') ? usersTablesHeading.reg : usersTablesHeading.gender;

  jQuery.each(tableHeading, function (i, val) {
      thead += '<td>' + val + '</td>';
  });
  thead += '</tr>';
  $('.tblUsers thead').html(thead);

  $.ajax({
    url: BASEPATH+'userDashboard/getUsersDetails',
    type: 'post',
    data: {state : where, column : columnName},
    cache: false,
    success: function(res) {
      // console.log(res);return;
      var data = JSON.parse(res);
      var str = '';
      var j = 1;
      for (var i = 0 ; i < data.length; i++) {
          
          str+="<tr><td>"+j+"</td>";
          str+="<td>"+data[i]['user_name']+"</td>";
          str+="<td>"+data[i]['user_email']+"</td>";

          if(heading == 'reg'){
            str+="<td>"+data[i]['gender']+"</td>";
          }

          var status = (data[i]['active']==1) ? 'Active' : 'In-Active';
          var rowClass = (data[i]['active']==1) ? 'label label-success' : 'label label-danger';
          str+="<td><span class='"+rowClass+"'>"+status+"</span></td>";
          
          if(heading == 'gender'){
            var userType = (data[i]['status']==1) ? 'Registered' : 'Non-Registered';
            var typeClass = (data[i]['status']==1) ? 'label label-success' : 'label label-warning';
            str+="<td><span class='"+typeClass+"'>"+userType+"</span></td>";
          }

          if((data[i]['attendence'] > 1) && (data[i]['attendence'] < 50)){
              var progressClass = 'progress-bar progress-bar-danger';
          }else if((data[i]['attendence'] > 50) && (data[i]['attendence'] < 70)){
              var progressClass = 'progress-bar progress-bar-warning';
          }else if((data[i]['attendence'] > 70) && (data[i]['attendence'] < 100)){
              var progressClass = 'progress-bar progress-bar-success';
          }else{
              var progressClass = 'progress';
          }

          str+="<td>"+data[i]['date_of_birth']+"</td>";
          str+="<td><div class='progress'><div class='"+progressClass+"' role='progressbar' aria-valuenow='"+data[i]['attendence']+"' aria-valuemin='0' aria-valuemax='100' style='width: "+data[i]['attendence']+"%;'>"+data[i]['attendence']+"%</div></div></td></tr>";

          j++;
      }
      
      $("#tblUsersBody").html(str);
      $('.tblUsers').DataTable();
    }

  });

}
