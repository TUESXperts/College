$(document).ready(function(){
    // Global variables
    var firstTimeAddingParentExamination = true;
    var firstTimeAddingChildExamination = true;
    var remove_parents_ids = [];
    var clicked_parent_research;

    $(".research_parent_row").click(function(){
        clicked_parent_research = $(this).attr("data-id");

        //let clicked_parent_research = $(this);
        $.ajax({
            url: "examinations.php",
            method: "POST",
            data: {command: "getAllResearchChildren", research_parent_id: clicked_parent_research},
            success: function(result){
                json = JSON.parse(result);

                $("#research_children_wrapper").empty();

                if(json.length == 0)  {
                    $("#research_children_wrapper").prepend(
                        '<table class="table" id="research_children_table">' +
                        '<thead>' +
                        '<tr>' +
                        '<th scope="col">Name</th>' +
                        '<th scope="col">Result</th>' +
                        '<th scope="col">Units</th>' +
                        '<th scope="col">Reference value</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody></tbody>' +
                        '</table>');

                    $("#research_children_wrapper").append(
                        '<div class="empty_children_input_wrapper">' +
                        '</div>'
                    );

                    $("#research_children_wrapper").append("<h4 id='no_children_research_nodes'>No results had been found.</h4>");

                    // Append Add or Remove buttons
                    $("#research_children_wrapper").append(
                        '<div class="form-group" style="display: flex;">' +
                        '<div class="button_add_child">' +
                        '<i class="fas fa-plus-circle"></i>' +
                        '</div>' +
                        '<div class="button_remove_child">' +
                        '<i class="fas fa-minus-circle"></i>' +
                        '</div>' +
                        '</div>'
                    );

                    return;
                }

                $("#research_children_wrapper").prepend('<table class="table" id="research_children_table">' +
                    '<thead>' +
                    '<tr>' +
                    '<th scope="col">Name</th>' +
                    '<th scope="col">Result</th>' +
                    '<th scope="col">Units</th>' +
                    '<th scope="col">Reference value</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>');

                json.forEach(row => {
                    $("#research_children_table").append('<tr class="research_child_row">' +
                        '<td>' + row.name + '</td>' +
                        '<td>' + row.result + '</td>' +
                        '<td>' + row.units + '</td>' +
                        '<td>' + row.reference_value + '</td>' +
                        '</tr>');
                });

                $("#research_children_table").append('</tbody>' +
                    '</table>');

                $("#research_children_wrapper").append(
                    '<div class="empty_children_input_wrapper">' +
                    '</div>'
                );

                // Append Add or Remove buttons
                $("#research_children_wrapper").append(
                    '<div class="form-group" style="display: flex;">' +
                    '<div class="button_add_child">' +
                    '<i class="fas fa-plus-circle"></i>' +
                    '</div>' +
                    '<div class="button_remove_child">' +
                    '<i class="fas fa-minus-circle"></i>' +
                    '</div>' +
                    '</div>'
                );

            }
        });
    });

    $(document).on("click", ".button_add_parent, .button_remove_parent, .button_add_child", function(){
        if($("#save_examinations").length == 0) {
            $("body").append(
                '<div style="text-align:center;">' +
                '<button type="button" id="save_examinations" class="btn btn-primary">Save</button>'+
                '</div>'
            );
        }
    });

    $(".button_add_parent").click(function(){

        if($("#parent_examinations_tab_columns").length == 0) {
            $("#no_parent_examinations_nodes").remove();
            $("#parent_examinations_wrapper").append(
                '<div id="parent_examinations_tab_columns" style="font-weight: bold;color: white;margin-bottom: 30px;padding: 5px;">' +
                '<div style="display: inline-block;width: 50%;">Date</div>' +
                '<div style="display: inline-block;">Name</div>' +
                '</div>');
        }
        // Add input fields for each parent examination to the form
        $("#parent_examinations_wrapper").append(
            '<div style="color: white;padding-top: 20px;padding-bottom: 20px;padding-left: 8px;padding-right: 8px;" class="research_parent_row temp_parent">' +
            '<div style="display: inline-block;width: 50%;"><input type="date" name="date[]"></div>' +
            '<div style="display: inline-block;"><input type="text" name="name[]"></div>' +
            '</div>');

        firstTimeAddingParentExamination = false;
    });

    $(".button_remove_parent").click(function(){
        // Remove last Parent element
        let last_parents_element = $(".research_parent_row").last();

        if(!last_parents_element.hasClass("temp_parent")){
            remove_parents_ids.push(last_parents_element.attr("data-id"));
            console.log(remove_parents_ids);
            console.log("inside the if sttement")
        }

        last_parents_element.remove();
    });

    $(document).on("click", ".button_remove_child", function(){
        // Remove last Parent element
        let last_children_element = $(".research_child_row").last();
        last_children_element.remove();
    });


    $(document).on('click','#save_examinations', function(){
        // Parents data
        let form = $("form");
        const urlParams = new URLSearchParams(window.location.search);
        const patient_id = urlParams.get('userid');
        form.append('<input type="hidden" name="patient_id" value="' + patient_id + '">');
        // form.append('<input type="hidden" name="remove_parents_ids[]" value="' + remove_parents_ids + '">');
        form.append('<input type="hidden" name="research_parent_id" value="' + clicked_parent_research + '">');
        form.append('<input type="hidden" name="command" value="save_examinations">');

        // For removing parent examinations
        // $.ajax({
        //     url: "examinations.php",
        //     method: "POST",
        //     data:  { formData: form.serialize(), patient_id, remove_parents_ids, command: save_examinations },
        //     success: function(data) {
        //         alert(data);
        //     }
        // });

        form.submit();
    });


    // Children
    $(document).on("click", ".button_add_child", function(){

        // Add input fields for each parent examination to the form
        $(".empty_children_input_wrapper").append(
            '<div style="color: white;padding-top: 20px;padding-bottom: 20px;padding-left: 8px;padding-right: 8px;" class="temp_child">' +
            '<div style="display: inline-block;width:25%;"><input type="text" name="children_name[]" style="width:100%;"></div>' +
            '<div style="display: inline-block;width:25%;"><input type="text" name="result[]" style="width:100%;"></div>' +
            '<div style="display: inline-block;width:25%;"><input type="text" name="units[]" style="width:100%;"></div>' +
            '<div style="display: inline-block;width:25%;"><input type="text" name="reference_value[]" style="width:100%;"></div>' +
            '</div>');

        firstTimeAddingChildExamination = false;
    });

});