

<script>
    function jsGTIN(event) {
        //       // left arrow: 37
        //       // up arrow: 38
        //       // right arrow: 39
        //       // down arrow: 40
        //       // Enter : 13
        //       // Esc: 27
        //alert(event.keyCode);
        //console.log(event.keyCode);
        var keyCode = event.keyCode || event.which;
        if (keyCode === 13 || keyCode === 39 || keyCode === 40) {
            var currentTd = event.target;
            var currentTr = currentTd.parentNode;
            var columnCells = Array.from(currentTr.parentNode.querySelectorAll(' :scope> tr > td:nth-child(' + (currentTd.cellIndex + 1) + ')'));
            //console.log('currentCells', columnCells);
            var currentIndex = columnCells.indexOf(currentTd);
            //console.log('currentIndex', currentIndex);
            if (currentIndex < columnCells.length - 1) {
                // event.preventDefault(); //prevent the browser to execute default action. Here, it will prevent browser to be refresh
                var nextTd = columnCells[currentIndex + 1];
                nextTd.focus();
                x = document.getElementById("mastertable").rows.length;
                var tr = document.getElementsByTagName("tr")[currentIndex + 2];
                var tabela = document.getElementById("mastertable");
                var td_id = tabela.rows[currentIndex + 1].cells[0].textContent;
                var td_codrec = tabela.rows[currentIndex + 1].cells[1].textContent;
                var td_desrec = tabela.rows[currentIndex + 1].cells[2].textContent;
                var td_uTrib = tabela.rows[currentIndex + 1].cells[3].textContent;
                var td_pesoB = tabela.rows[currentIndex + 1].cells[4].textContent;
                var td_pesoL = tabela.rows[currentIndex + 1].cells[5].textContent;
                var td_qUnEmb = tabela.rows[currentIndex + 1].cells[6].textContent;
                window.opener.document.getElementById("id").value = td_id;
                window.opener.document.getElementById("codrec").value = td_codrec;
                window.opener.document.getElementById("desrec").value = td_desrec;
                window.opener.document.getElementById("uTrib").value = td_uTrib;
                window.opener.document.getElementById("pesoB").value = td_pesoB;
                window.opener.document.getElementById("pesoL").value = td_pesoL;
                window.opener.document.getElementById("qUnEmb").value = td_qUnEmb;
            };
            var codrec = window.opener.document.getElementById("codrec").value;
            console.log(' td_codrec684=' + td_codrec);
            updatejsGTIN(td_id.trim(), td_pesoB.trim(), td_pesoL.trim(), td_qUnEmb.trim())
        }
        //   var jsdesrec = document.getElementsByName("desrec")[0].value;
        //   console.log(' jsdesrec', jsdesrec);
        // var jsdesrec=document.getElementsByName("desrec")[0].value;
        // // left arrow: 37
        // // up arrow: 38
        if (event.keyCode === 38) {
            var currentTd = event.target;
            var currentTr = currentTd.parentNode;
            var columnCells = Array.from(currentTr.parentNode.querySelectorAll(':scope> tr > td:nth-child(' + (currentTd.cellIndex + 1) + ')'));
            var currentIndex = columnCells.indexOf(currentTd);
            if (currentIndex < columnCells.length - 1) {
                var nextTd = columnCells[currentIndex - 1];
                nextTd.focus();
            }
            var tr = document.getElementsByTagName("tr")[currentIndex + 2];
            var tabela = document.getElementById("mastertable");
            var td_id = tabela.rows[currentIndex + 1].cells[0].textContent;
            var td_codrec = tabela.rows[currentIndex + 1].cells[1].textContent;
            var td_desrec = tabela.rows[currentIndex + 1].cells[2].textContent;
            var td_uTrib = tabela.rows[currentIndex + 1].cells[3].textContent;
            var td_pesoB = tabela.rows[currentIndex + 1].cells[4].textContent;
            var td_pesoL = tabela.rows[currentIndex + 1].cells[5].textContent;
            var td_qUnEmb = tabela.rows[currentIndex + 1].cells[6].textContent;
            window.opener.document.getElementById("id").value = td_id;
            window.opener.document.getElementById("codrec").value = td_codrec;
            window.opener.document.getElementById("desrec").value = td_desrec;
            window.opener.document.getElementById("uTrib").value = td_uTrib;
            window.opener.document.getElementById("pesoB").value = td_pesoB;
            window.opener.document.getElementById("pesoL").value = td_pesoL;
            window.opener.document.getElementById("qUnEmb").value = td_qUnEmb;
            var codrec = window.opener.document.getElementById("codrec").value;
            console.log('td_codrec=718 ' + td_codrec);
            updatejsGTIN(td_id.trim(), td_pesoB.trim(), td_pesoL.trim(), td_qUnEmb.trim())
        }
        if (event.keyCode == 37) { //left arrow: 37
            event.preventDefault();
            // Verificar se a célula atual não é a última
            var currentTd = event.target;
            var currentTr = currentTd.parentNode;
            var previousTr = currentTr.previousElementSibling;
            var previousTd = currentTr.getElementsByTagName(' td')[currentTd.cellIndex - 1];
            previousTd.focus();
            var tr = document.getElementsByTagName("tr")[currentIndex + 2];
            var tabela = document.getElementById("mastertable");
            var td_id = tabela.rows[currentIndex + 1].cells[0].textContent;
            var td_codrec = tabela.rows[currentIndex + 1].cells[1].textContent;
            var td_desrec = tabela.rows[currentIndex + 1].cells[2].textContent;
            var td_uTrib = tabela.rows[currentIndex + 1].cells[3].textContent;
            var td_pesoB = tabela.rows[currentIndex + 1].cells[4].textContent;
            var td_pesoL = tabela.rows[currentIndex + 1].cells[5].textContent;
            var td_qUnEmb = tabela.rows[currentIndex + 1].cells[6].textContent;
            window.opener.document.getElementById("id").value = td_id;
            window.opener.document.getElementById("codrec").value = td_codrec;
            window.opener.document.getElementById("desrec").value = td_desrec;
            window.opener.document.getElementById("uTrib").value = td_uTrib;
            window.opener.document.getElementById("pesoB").value = td_pesoB;
            window.opener.document.getElementById("pesoL").value = td_pesoL;
            window.opener.document.getElementById("qUnEmb").value = td_qUnEmb;
            var codrec = window.opener.document.getElementById("codrec").value;
            console.log('td_codrec=' + td_codrec);
            updatejsGTIN(td_id.trim(), td_pesoB.trim(), td_pesoL.trim(), td_qUnEmb.trim())
        }
        if (event.keyCode == 39) { // right arrow: 39
            event.preventDefault();
            // Verificar se a célula atual não é a última
            var currentTd = event.target;
            var currentTr = currentTd.parentNode;
            var previousTr = currentTr.previousElementSibling;
            var previousTd = currentTr.getElementsByTagName(' td')[currentTd.cellIndex + 1];
            previousTd.focus();
            var tr = document.getElementsByTagName("tr")[currentIndex + 2];
            var tabela = document.getElementById("mastertable");
            var td_id = tabela.rows[currentIndex + 1].cells[0].textContent;
            var td_codrec = tabela.rows[currentIndex + 1].cells[1].textContent;
            var td_desrec = tabela.rows[currentIndex + 1].cells[2].textContent;
            var td_uTrib = tabela.rows[currentIndex + 1].cells[3].textContent;
            var td_pesoB = tabela.rows[currentIndex + 1].cells[4].textContent;
            var td_pesoL = tabela.rows[currentIndex + 1].cells[5].textContent;
            var td_qUnEmb = tabela.rows[currentIndex + 1].cells[6].textContent;
            window.opener.document.getElementById("id").value = td_id;
            window.opener.document.getElementById("codrec").value = td_codrec;
            window.opener.document.getElementById("desrec").value = td_desrec;
            window.opener.document.getElementById("uTrib").value = td_uTrib;
            window.opener.document.getElementById("pesoB").value = td_pesoB;
            window.opener.document.getElementById("pesoL").value = td_pesoL;
            window.opener.document.getElementById("qUnEmb").value = td_qUnEmb;
            var codrec = window.opener.document.getElementById("codrec").value;
            console.log('td_codrec=' + td_codrec);
            updatejsGTIN(td_id.trim(), td_pesoB.trim(), td_pesoL.trim(), td_qUnEmb.trim())
        }
    }
</script>


<script>
    //updatejsGTIN(td_id.trim(), td_pesoB.trim(), td_pesoL.trim(), td_qUnEmb.trim())
    function updatejsGTIN(upid = '', upesoB = '', upesoL = '', uqUnEmb = '') {
        //https: //www.laratutorials.com/codeigniter-4-ajax-crud-operation-example-tutorial/
        //function updatejsGTIN() {
        //       // left arrow: 37
        //       // up arrow: 38
        //       // right arrow: 39
        //       // down arrow: 40
        //       // Enter : 13
        //       // Esc: 27
        if (upid == '' || upid == null) {
            alert(' Sem id na tabela,informe o suporte pfv!')
            return false
        }
        console.log('upid', upid, 'upesoB', upesoB, 'upesoL', upesoL, 'uqUnEmb', uqUnEmb);
        var base_url = "<?php echo base_url() ?>";
        if (uqUnEmb == '') {
            uqUnEmb = 'null'
        }
        if (upesoB == '') {
            upesoB = 'null'
        }
        if (upesoL == '') {
            upesoL = 'null'
        }
        var post_url = "/C_Cadrec/jsAjaxUpdateCadrecTable/" + upid + "/" + upesoB + "/" + upesoL + "/" + uqUnEmb;
        var urlFull = base_url + post_url;
        console.log("post_url", post_url);
        console.log("urlFull", urlFull);
        query = "id: upid, pesoL: upesoB,PesoB: upesoL,qUnEmb: uqUnEmb ";
        $.ajax({
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            url: urlFull,
            method: "post",
            async: false,
            dataType: 'json',
            encode: false,
            contentType: "application/json; charset=utf-8",
            data: [query],
            success: function(data) {
                console.log('sucess_data', data);
            },
            error: function(err) {
                console.log('error_data', data);
            }
        })
        event.preventDefault();
        return;
    }
</script>
