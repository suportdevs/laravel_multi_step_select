<x-admin-layout>
    <div class="content-wrapper">
        <div class="content">
            <!-- Top Statistics -->
            <div class="row">
                @if(session('status'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Add New Thana</h3>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form action="{{ route('insert.upazila') }}" method="POST">
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
                                                <option value="">Select Any District</option>
                                            </select>
                                        </div>
                                        <div class="mt-4">
                                            <label for="">Thana</label>
                                            <input type="text" name="upazila" id="" class="form-control" placeholder="Thana">
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
    $(document).ready(function(){
       const dropdownData = () => {
        $("#devision").change(function() {
            var id = $("#devision").val();
            getDistrict(id);
        });

        const getDistrictData = (data) => {
            const district = document.querySelector("#district");
            district.innerHTML = data.map(item => `<option value=${item.id}>${item.district_name}</option>`).join(' ');
            return district;
        };

        const getDistrict = (devision_id) => {
            axios.post('/getDistrict', {id:devision_id})
            .then(response => {
                $("#district").empty();
                
                var data = response.data;
                getDistrictData(data);
            })
            .catch(function(error){
                document.write("Something went Wrong!");
            })
        }
        $("#district").change(function() {
            const id = $(this).val();
            // alert(id);
        });
        // const getThana = () => {
        //     axios.post


        // }
       }
       dropdownData();
    });
</script>