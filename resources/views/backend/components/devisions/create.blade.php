<x-admin-layout>
    <div class="content-wrapper">
        <div class="content">
            <!-- Top Statistics -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Add New Thana</h3>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form action="{{ route('insert.thana') }}" method="POST">
                                        @csrf
                                        <div class="devisions">
                                            <label for="">Devision</label>
                                            <select id="devision" name="devision" class="form-control">
                                                <option>Select Any Devision</option>
                                                @foreach($devisions as $devision)
                                                    <option value="{{ $devision->id }}">{{ $devision->devision_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-4">
                                            <label for="">District</label>
                                            <select id="district" name="district" class="form-control">
                                                <option >Select Any District</option>
                                                @foreach($districts as $district)
                                                    <option value="{{ $devision->id }}">{{ $district->district_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-4">
                                            <label for="">Thana</label>
                                            <input type="text" name="thana" id="" class="form-control" placeholder="Thana">
                                        </div>
                                        <div class="justify-content-center text-center">
                                            <button type="submit" class="btn btn-primary mt-4 text-center">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
<script>
    // $(document).ready(function(){
    //     $("#devision").change(function() {
    //         var id = $(this).val();
    //         getDistrictData(id);
    //     });
    //     function getDistrictData(devision_id){
    //         const url = '/getDistrict'
    //         axios.post(url, {id:devision_id})
    //         .then(function(res){
    //             var data = res.data;
    //             $.each(data, function(i, item){
    //                 $("<option>").html(
    //                     "<option id=" + data[i].id + ">" + data[i].district_name +"</option>"
    //                 ).appendTo("#district");
    //             })
    //         })
    //         .catch(function(error){
    //             return "false";
    //         })
    //     };
    //     $("#district").change(function(){
    //         var id = $(this).attr('id');
    //         alert(id);
    //     })
    // });
</script>