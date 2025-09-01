function deleteFile(id) {
        let agreeDelete = confirm("Είστε σίγουροι για τη διαγραφή;");
        if (agreeDelete) {
            $.post("/aggelia/file-delete.json", {id: id}, function (e) {
                alert( e.message );
                if (e.data.result == true) {
                   $("#employersGrid").dxDataGrid("instance").refresh();  
                   
                }
//                setTimeout(function () {
//                    document.getElementById("jobFileMessages").textContent = "";
//                }, 3000);
            });
        }
    }

document.addEventListener('DOMContentLoaded', function (el) {

    let serviceUrl = location.protocol + '//' + location.host;
    let employersMasterGrid;
    let idEmployerDoc;
    $("#employersGrid").dxDataGrid({
        columns: [
            {
                dataField: "idEmployerType",
                caption: "Τύπος",
                fixed: true,
                validationRules: [{type: 'required'}],
                lookup: {
                    dataSource: {
                        store: {
                            type: 'array',
                            data: [
                                {id: 1, name: 'Εταιρεία'},
                                {id: 2, name: 'Ιδιώτης'}
                            ],
                            key: 'id'
                        }
                    },
                    valueExpr: 'id',
                    displayExpr: 'name'
                }
            },
            {
                dataField: "DiscreteTitle",
                caption: "Διακρ. Τίτλος",
                fixed: true,
                validationRules: [{type: 'required'}]
            },
            {
                dataField: "Profession",
                caption: "Επάγγελμα",
                visible: false,
                validationRules: [{type: 'required'}]
            },
            {
                dataField: "idIndustry",
                caption: "Βιομηχανία",
                visible: false,
                validationRules: [{type: 'required'}],
                lookup: {
                    dataSource: employerIndustries,
                    valueExpr: 'idIndustry',
                    displayExpr: 'industry'
                }

            },
            {
                dataField: "EmpArea",
                caption: " Πόλη",
                validationRules: [{type: 'required'}]
            },
            {
                dataField: "EmpAddress",
                caption: "Δ/νση",

            },
            {
                dataField: "Zip",
                caption: "Ταχ. Κωδ.",
                validationRules: [
                    {
                        type: 'pattern',
                        pattern: '^\\d{5,}$',
                        message: 'Συμπληρώστε με τουλάχιστον 5 αριθμητικά ψηφία'
                    }
                ]
            },
            {
                dataField: "Telephone",
                caption: "Τηλέφωνο",
                validationRules: [
                    {
                        type: 'pattern',
                        pattern: '^\\d{10,}$',
                        message: 'Συμπληρώστε με τουλάχιστον 10 αριθμητικά ψηφία'
                    }]
            },
            {
                dataField: "Mobile",
                caption: "Κιν. Τηλέφωνο",
                validationRules: [
                    {
                        type: 'pattern',
                        pattern: '^\\d{10,}$',
                        message: 'Συμπληρώστε με τουλάχιστον 10 αριθμητικά ψηφία'
                    }]
            },
            {
                dataField: "Email",
                caption: "E-mail",
                validationRules: [
                    {type: 'email',
                        message: 'Μη Έγκυρο e-mail'}],

            },
            {
                dataField: "WebPage",
                caption: "Ιστοσελίδα",
                visible: false,

            },
            {
                dataField: "TaxNo",
                caption: "Α.Φ.Μ",
                validationRules: [
                    {type: 'pattern',
                        pattern: '^\\d{9}$',
                        message: "Το Α.Φ.Μ είναι υποχρεωτικό με 9 αριθμητικά ψηφία."
                    }],

            },
            {
                dataField: "TaxOffice",
                caption: "ΔΟΥ",
                visible: false,
            },
            {
                dataField: "idCountry",
                caption: "Χώρα",
                visible: false,
                lookup: {
                    dataSource: employerCountries,
                    valueExpr: 'idCountry',
                    displayExpr: 'country'
                }
            },
            {
                dataField: "Comments",
                caption: "Σχόλια",
                visible: false,
                formItem: {
                    colSpan: 2,
                    editorType: 'dxTextArea',
                    editorOptions: {
                        height: 200,
                    },
                }
            }
        ],

        dataSource: DevExpress.data.AspNet.createStore({
            key: "id",
            loadUrl: serviceUrl + '/employerlist.json?task=Employer.Devex', //(serviceUrl.indexOf('?') > -1 ? '&' : '?') + 'task=Employer.display',
            insertUrl: serviceUrl + '/employer-save.json?task=Employer.savedx',
            updateUrl: serviceUrl + '/employer-save.json?task=Employer.savedx',
            deleteUrl: serviceUrl + '/employer-save.json?task=Employer.delete',
            updateMethod: "POST",
            deleteMethod: "POST",
            refreshMode: 'reshape',

        }),
        remoteOperations: true,
        height: 600,
        filterRow: {
            visible: true
        },
        editing: {
            mode: 'popup',
            allowUpdating: true,
            allowDeleting: true,
            allowAdding: true
        },
        onInitialized: function (e) {
            employersMasterGrid = e.component;
        },

        onRowExpanded: function (e) {
            idEmployerDoc = e.key;
//            let index = masterGrid.getRowIndexByKey(e.key);  
//            let value = masterGrid.cellValue(index, "id");
        },
        masterDetail: {
            enabled: true,
            template(container, options) {

                let currentEmployerDetails = options.data.details;

                $('<div>')
                        .dxDataGrid({
                            columnAutoWidth: true,
                            showBorders: true,
                            columns: [
                                /**
                                 {
                                 caption: 'Αγγελία',
                                 dataField: 'idJobTitle',
                                 
                                 cellTemplate(container, options) {
                                 let html = '<a href="/aggelia.html?id=' + options.data.idJob + '" target="_blank" >(' + options.data.idJob + ') ' + options.data.jobTitle + '</a>';
                                 container.html(html);
                                 }
                                 
                                 lookup: {
                                 
                                 }
                                 },
                                 *
                                 */
                                {
                                    caption: 'Αρχείο',
                                    dataField: 'documentFilePath',
                                    cellTemplate(container, options) {
                                        let html = '<div id="uploadedDocuments"><div class="d-inline bg-info"><a href="' + options.data.documentFilePath + '" target="_blank" >' + options.data.documentFilePath.split('\\').pop().split('/').pop() + '</a><span onclick="deleteFile(' + options.data.id + ')">x</span></div></div>';
                                        container.html(html);
                                    },
                                    editCellTemplate: editEmployerJodDocTemplate
                                    
                                   
                                }


                            ],
                            dataSource: currentEmployerDetails,
                            keyExpr: "id",
                            editing: {
                                allowAdding: true,
                                allowEditing: false,
                                allowDeleting: true                
                            }
                        })
                        .appendTo(container);



            }
        } //masterdetail
    });

    


    function editEmployerJodDocTemplate(cellElement, cellInfo) {

        let fileUploaderElement = document.createElement("div");
        $(fileUploaderElement).dxFileUploader({

            multiple: true,
            uploadMode: "instantly",
            uploadUrl: serviceUrl + "/employerlist.json?task=Employer.uploaddx&idEmployer=" + idEmployerDoc + '&idJob=',
            onUploadStarted: function (e) {
                let idJob = cellInfo.row.cells[0].value;

            },

            onUploadError: function (e) {
                let xhttp = e.request;
                if (xhttp.status === 400) {
                    e.message = e.error.responseText;
                }
                if (xhttp.readyState === 4 && xhttp.status === 0) {
                    e.message = "Connection refused";
                }
            },            
            onFilesUploaded: function(e) {
                   $("#employersGrid").dxDataGrid("instance").refresh();  
                                       
            }
        }).dxFileUploader("instance");

//        let imageElement = document.createElement("img");
//        imageElement.classList.add("uploadedImage");
//        imageElement.setAttribute('src', backendURL + cellInfo.value);

//        cellElement.append(imageElement);
        cellElement.append(fileUploaderElement);
//        cellElement.append(buttonElement);
    }


});
               
