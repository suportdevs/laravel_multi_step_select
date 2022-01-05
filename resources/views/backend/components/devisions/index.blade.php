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
                                            <option value="{{ $devision->id }}">{{ $devision->devision_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">District</label>
                                    <select id="district" class="form-control">
                                        <option type="hidden" value="">Select Any District</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Thana</label>
                                    <select id="thana" class="form-control">
                                        <option type="hidden" value="">Select Any District</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="">Area Details</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ url('/add/new/thana') }}">
                                        <button class="btn btn-primary btn-sm"><span class="mdi mdi-plus-outline"></span> New</button>
                                    </a>
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
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                    @php($i = 1)
                                    @foreach($result as $data)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $data->devision_name }}</td>
                                        <td>{{ $data->district_name }}</td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
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
        
        // axios.get('/devisions')
        // .then(function(res){
        //     console.log(res.data);
        // })
        // .catch(function(error){
        //     console.log(error);
        // })
       function dropdownData(){
        $("#devision").change(function() {
            var id = $("#devision").val();
            getDistrict(id);
        });
        function getDistrict(devision_id){
            // alert(devision_id);
            axios.post('/getDistrict', {id:devision_id})
            .then(function(response){
                $("#district").empty();
                $("#table-data").empty();
                if(response.status == 200){
                    var data = response.data;
                    console.log(data);
                    $.each(data, function(i, item){
                        $("<option>").html(
                            "<option data-id="+ data[i].id +">" + data[i].district_name +"</option>"
                            ).appendTo("#district");
                        $("<tr>").html(
                            "<td>" + i + "</td>" +
                            "<td>" + data[i].devision_name + "</td>" +
                            "<td>" + data[i].district_name + "</td>" +
                            "<td><a href='' class='btn btn-primary btn-sm text-right'>Edit</a><a href='' class='btn btn-danger btn-sm text-right'>Delete</a></td>"
                        ).appendTo("#table-data");
                    });
                }else {
                    alert('Failed');
                }
            })
            .catch(function(error){
                
            })
        }
        $("#district").change(function(){
            const id = $(this).attr('data-id');
            alert(id);
        })
       }
       dropdownData();
    });
</script>