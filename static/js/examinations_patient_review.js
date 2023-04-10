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
            }
        });
    });
});