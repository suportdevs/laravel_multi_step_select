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
                                    <select id="upazila" class="form-control">
                                        <option type="hidden" value="">Select Any Upazila</option>
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
                                    <a href="{{ url('/add/new/upazila') }}">
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
                                        <th>Upazila</th>
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
                                        <td>{{ $data->upazila_name }}</td>
                                        <td class="text-right">
                                            <a href="{{ url('/upazila/edit/'.$data->id) }}" class="btn btn-primary btn-sm"><span class="mdi mdi-wrench"></span></a>
                                            <a href="" class="btn btn-danger btn-sm"><span class="mdi mdi-trash-can"></span></a>
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
       function dropdownData(){
        $("#devision").change(function() {
            var id = $("#devision").val();
            getDistrict(id);
        });

        const getDistrictData = (data) => {
            const district = document.querySelector("#district");
            district.innerHTML = data.map(item => `<option value=${item.id}>${item.district_name}</option>`).join(' ');
            return district;
        };

        const getTableData = (data) => {
            const tableData = document.querySelector("#table-data");
            tableData.innerHTML = data.map(item => `<tr>
                <td>${item.id}</td>
                <td>${item.devision_name}</td>
                <td>${item.district_name}</td>
                <td>${item.upazila_name}</td>
                <td class='text-right'>
                    <a href='{{ url('upazila/edit/${item.id}') }}' class='btn btn-primary btn-sm'><span class='mdi mdi-wrench'></span></a>
                    <a href='#' class='btn btn-danger btn-sm'><span class='mdi mdi-trash-can'></span></a>
                </td>
                </tr>
            `).join(' ');
            return tableData;
        }

        const getDistrict = (devision_id) => {
            axios.post('/getDistrict', {id:devision_id})
            .then(response => {
                $("#district").empty();
                $("#table-data").empty();
                
                var data = response.data;
                getDistrictData(data);
                getTableData(data);
            })
            .catch(function(error){
                document.write("Something went Wrong!");
            })
        }
        $("#district").change(() => {
            const id = $("#district").val();
            getUpazila(id);
        });
        const getUpazilaDropdown = (data) => {
            const upazilaId = document.querySelector("#upazila");
            upazilaId.innerHTML = data.map(item => `<option value='${item.id}>${item.upazila_name}</option>`)
        }
        // const get
        const getUpazila = (district_id) => {
            axios.post('/getUpazila', {id:district_id})
            .then(response => {
                let upazilaData = response.data;
                getUpazilaDropdown(upazilaData);
                getTableData(upazilaData);
            })
        }
    }
       
       dropdownData();
    });
</script>