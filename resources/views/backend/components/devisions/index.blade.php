<x-admin-layout>
    <div class="content-wrapper">
        <div class="content">
            <!-- Top Statistics -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Select Area</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Devision</label>
                                    <select id="devision" class="form-control">
                                        <option>Select Any Devision</option>
                                        @foreach($devisions as $devision)
                                            <option data-id="{{ $devision->id }}" value="{{ $devision->id }}">{{ $devision->devision_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="dis" class="col-md-4">
                                    <label for="">District</label>
                                    <select id="district" class="form-control">
                                        <option type="hidden" value="">Select Any District</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="">Area Details</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button class="btn btn-primary btn-sm">New</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Devision</th>
                                        <th>District</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
<script>
    $(document).ready(function(){
        $("#devision").change(function() {
            var id = $("#devision").val();
            getDistrict(id);
        });
        function getDistrict(devision_id){
            // alert(devision_id);
            axios.post('/district', {id:devision_id})
            .then(function(response){
                $("#district").empty();
                $("#table-data").empty();
                if(response.status == 200){
                    var data = response.data;
                    console.log(data);
                    $.each(data, function(i, item){
                        $("<option>").html(
                            "<option value="+ data[i].id +">" + data[i].district_name +"</option>"
                            ).appendTo("#district");
                        $("<tr>").html(
                            "<td>" + i + "</td>" +
                            "<td>" + data[i].devision_name + "</td>" +
                            "<td>" + data[i].district_name + "</td>"
                        ).appendTo("#table-data");
                    });
                }else {
                    alert('Failed');
                }
            })
            .catch(function(error){
                
            })
        }
    });
</script>