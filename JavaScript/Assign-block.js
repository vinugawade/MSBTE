// ASSIGNMENT - TABLE GET ROW
for (i = 1; i < document.getElementById("Blocks-Table-View").rows.length; i++) {
  document
    .getElementById("Blocks-Table-View")
    .rows[i].addEventListener("click", function () {
      block_no = this.cells[0].innerHTML;
      idate = this.cells[1].innerHTML;
      isession = this.cells[2].innerHTML;
      start = this.cells[3].innerHTML;
      end = this.cells[4].innerHTML;
    });
}
// ASSIGNMENT - TABLE GET ROW

function updatesupervisor(supervisor) {
  window.location.assign(
    "../DataBase/Assign-Block-DB.php?isupervisor=" +
      supervisor +
      "&block_no=" +
      block_no +
      "&idate=" +
      idate +
      "&isession=" +
      isession +
      "&start=" +
      start +
      "&end=" +
      end +
      "&update=1#update"
  );
}

$(document).ready(function () {
  // Setup - add a text input to each footer cell
  $("#Blocks-Table-View thead tr")
    .clone(true)
    .appendTo("#Blocks-Table-View thead");
  $("#Blocks-Table-View thead tr:eq(1) th").each(function (i) {
    $(this).html('<input type="text" placeholder="Find" style="width:80%;" />');

    $("input", this).on("keyup change", function () {
      if (table.column(i).search() !== this.value) {
        table.column(i).search(this.value).draw();
      }
    });
  });

  var table = $("#Blocks-Table-View").DataTable({
    paging: false,
    pageLength: false,
  });
});

function checkDept(r) {
      if (document.getElementById("Blocks-Table-View").rows[r+1].cells[6].innerHTML.search("<select") === -1) {
         dept=document.getElementById("Blocks-Table-View").rows[r+1].cells[5].innerHTML.split(" ");
        if(dept.length>1){
            dept.forEach(e => {
                document.getElementById("dept").innerHTML+="<option value="+e+">"+e+"</option>";
            });
            $("#exampleModal").modal("show");
          }else{
              document.getElementById("dept")[0].value=dept[0];
              document.getElementById("submitForm").submit();
          }
      } else {
        alert("Please Assign Supervisor First.");
      }
}
