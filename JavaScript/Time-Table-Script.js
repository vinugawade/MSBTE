// function check() {
//     check = confirm("Are You Sure?");
//     if (check == true) {
//         alert(check);
//         // window.location = '../DataBase/Time-Table-DB.php#delete';
//         window.location.href = 'http://www.google.com';
//     } else {
//         alert(check);
//         window.location = '../PHP/TimeTable.php';
//     }
// }

// TIME - TABLE GET ROW
for (i = 1; i < document.getElementById('Time-Table-View').rows.length; i++) {
    document.getElementById('Time-Table-View').rows[i].addEventListener("click", function() {
        document.getElementById("get_id").value = this.cells[0].innerHTML;
        document.getElementById("day").value = this.cells[1].innerHTML;
        document.getElementById("date").value = this.cells[2].innerHTML;
        document.getElementById("time").value = this.cells[3].innerHTML;
        document.getElementById("hour").value = this.cells[4].innerHTML;
        document.getElementById("scheme").innerHTML = "<option value=" + this.cells[7].innerHTML + ">" + this.cells[7].innerHTML + "</option>";
        document.getElementById("department").value = this.cells[5].innerHTML;
        document.getElementById("year_sem").value = this.cells[6].innerHTML;
        document.getElementById("subject").innerHTML = "<option value=" + this.cells[8].innerHTML + ">" + this.cells[8].innerHTML + "</option>";
        document.getElementById("session").value = this.cells[9].innerHTML;
        document.getElementById("students_count").value = this.cells[10].innerHTML;
        document.getElementById("block_count").value = this.cells[11].innerHTML;
        confirm("Now Update Data For Selected Date & Subject.");
    });
}

$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#Time-Table-View thead tr').clone(true).appendTo('#Time-Table-View thead');
    $('#Time-Table-View thead tr:eq(1) th').each(function(i) {
        $(this).html('<input type="text" placeholder="Find" style="width:80%;" />');

        $('input', this).on('keyup change', function() {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        });
    });

    var table = $('#Time-Table-View').DataTable({
        paging: false,
        pageLength: false
    });
});
// TIME - TABLE GET ROW

// DYNAMIC DROPDOWNS

function random_function() {

    var a = document.getElementById("department").value;
    var b = document.getElementById("year_sem").value;
    var subjects = [];
    if (a === "Computer") {
        if (b === "F.Y.SEM-1") {
            subjects = ["English(22101)", "Chemistry(22102)", "Physics(22102)", "BMS(22103)"];
        } else if (b === "F.Y.SEM-2") {
            subjects = ["EEC(22215)", "AMI(22224)", "BEC(22225)", "PIC(22226)"];
        } else if (b === "S.Y.SEM-3") {
            subjects = ["OOP(22316)", "DSU(22317)", "CGR(22318)", "DMS(22319)", "DTE(22320)"];
        } else if (b === "S.Y.SEM-4") {
            subjects = ["JPR(22412)", "SEN(22413)", "DCC(22414)", "MIC(22415)"];
        } else if (b === "T.Y.SEM-5") {
            subjects = ["EST(22447)", "OSY(22516)", "AJP(22517)", "STE(22518)", "CSS(22519)", "ACN(22520)", "ADM(22521)"];
        } else if (b === "T.Y.SEM-6") {
            subjects = ["MGT(22509)", "PWP(22616)", "MAD(22617)", "ETI(22618)", "WBP(22619)", "NIS(22620)", "DWM(22621)"];
        }
    } else if (a === "Mechanical") {
        if (b === "F.Y.SEM-1") {
            subjects = ["English(22101)", "Chemistry(22102)", "Physics(22102)", "BMS(22103)"];
        } else if (b === "F.Y.SEM-2") {
            subjects = ["PHYSICS(22202)", "CHEMISTRY(22202)", "AME(22203)", "AMP(22206)", "EDR(22207)"];
        } else if (b === "S.Y.SEM-3") {
            subjects = ["SOM(22306)", "BEE(22310)", "TEN(22337)", "MWM(22341)", "EME(22342)", "MEM(22343)"];
        } else if (b === "S.Y.SEM-4") {
            subjects = ["TOM(22438)", "MEM(22443)", "FMM(22445)", "MPR(22446)", "EST(22447)"];
        } else if (b === "T.Y.SEM-5") {
            subjects = ["MAN(22509)", "PER(22562)", "AMP(22563)", "EMD(22564)", "TEN(22565)", "PPE(22566)"];
        } else if (b === "T.Y.SEM-6") {
            subjects = ["ETM(22652)", "IHP(22655)", "AEN(22656)", "IEQ(22657)", "CIM(22658)", "RAC(22660)", "RET(22661)"];
        }
    } else if (a === "Electrical") {
        if (b === "F.Y.SEM-1") {
            subjects = ["English(22101)", "Chemistry(22102)", "Physics(22102)", "BMS(22103)"];
        } else if (b === "F.Y.SEM-2") {
            subjects = ["AME(22210)", "PHYSICS(22211)", "CHEMISTRY(22211)", "FEE(22212)", "EOE(22213)", "BME(22214)"];
        } else if (b === "S.Y.SEM-3") {
            subjects = ["ECI(22324)", "EEM(22325)", "FPE(22326)", "EPG(22327)", "EMW(22328)"];
        } else if (b === "S.Y.SEM-4") {
            subjects = ["CNE(22418)", "EPT(22419)", "IME(22420)", "DEM(22421)", "EST(22447)"];
        } else if (b === "T.Y.SEM-5") {
            subjects = ["MAN(22509)", "IAM(22523)", "SAP(22524)", "ECA(22525)", "EIA(22526)", "PEA(22527)", "WPT(22528)", "PSA(22529)", "IEB(22530)"];
        } else if (b === "T.Y.SEM-6") {
            subjects = ["MEE(22625)", "UEE(22626)", "EEC(22627)", "ETE(22628)", "IDC(22629)", "PSO(22632)", "ESP(22633)"];
        }
    } else if (a === "Civil") {
        if (b === "F.Y.SEM-1") {
            subjects = ["English(22101)", "Chemistry(22102)", "Physics(22102)", "BMS(22103)"];
        } else if (b === "F.Y.SEM-2") {
            subjects = ["AMS(22201)", "PHYSICS(22202)", "CHEMISTRY(22202)", "AME(22203)", "CMA(22204)", "BSU(22205)"];
        } else if (b === "S.Y.SEM-3") {
            subjects = ["ASU(22301)", "HEN(22302)", "MOS(22303)", "BCO(22304)", "CTE(22305)"];
        } else if (b === "S.Y.SEM-4") {
            subjects = ["HRY(22401)", "TOS(22402)", "RBE(22403)", "GTE(22404)", "BPD(22405)", "EST(22447)"];
        } else if (b === "T.Y.SEM-5") {
            subjects = ["WRE(22501)", "DSR(22502)", "EAC(22503)", "PHE(22504)", "RDE(22505)", "ECG(22506)", "TEN(22507)", "PPC(22508)"];
        } else if (b === "T.Y.SEM-6") {
            subjects = ["MAN(22509)", "CAA(22601)", "MRS(22602)", "ETC(22603)", "BSE(22604)", "SWM(22605)", "ERB(22606)", "ADE(22607)"];
        }
    }
    var string = "<option>Select Subject</option>";
    for (i = 0; i < subjects.length; i++) {
        string = string + "<option value=" + subjects[i] + ">" + subjects[i] + "</option>";
    }
    document.getElementById("subject").innerHTML = string;
}
// DYNAMIC DROPDOWNS
document.getElementById("students_count").addEventListener('input', function() {
    var students = document.getElementById("students_count").value;
    var count = (students / 5);
    document.getElementById('block_count').value = Math.ceil(count);
});

document.getElementById("block_count").addEventListener('input', function() {
    var students = document.getElementById("students_count").value;
    var count = (students / 5);
    document.getElementById('block_count').value = Math.ceil(count);
});