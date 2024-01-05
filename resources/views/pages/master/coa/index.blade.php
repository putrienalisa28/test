@section('title', 'Master Of Coa')
@extends('layouts.main')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Master /</span> COA</h4>
    <!-- DataTable with Buttons -->
    <div class="row">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="card-datatable table-responsive pt-3" style="height: 700px;">
                    <div x-data="{
                            coas: null,
                            loading: true,
                            fetchCoas: async function() {
                                try {
                                const response = await axios.get('http://127.0.0.1:8000/api/coa/getAllByParam');
                                this.coas = response.data.result;
                                this.loading = false;
                                } catch (error) {
                                console.log(error);
                                }
                            }
                            }" x-init="fetchCoas()">
                        <template x-if="loading">
                            <p>Loading...</p>
                        </template>
                        <template x-if="coas && !loading">
                            <table class="table table-responsive table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>COA ID</th>
                                        <th>Name</th>
                                        <th>Group COA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="coa in coas" :key="coa.NoCOA">
                                        <tr>
                                            <td x-text="coa.NoCOA"></td>
                                            <td x-text="coa.AccountName"></td>
                                            <td x-text="coa.GroupName"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Form Input COA</h5>
                <div class="card-body">
                    <div x-data="{ accountNumber : '', accountName: '', groupName: '', }">
                        <form @submit.prevent="saveData()">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Number COA</label>
                                <input type="text" x-model="accountNumber" name="accountNumber" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Account Name</label>
                                <input type="text" x-model="accountName" name="accountName" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Group COA</label>
                                <select class="form-select" x-model="groupName" name="groupName" id="exampleFormControlSelect1" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="pt-1">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>
    function saveData() {
        let accountNumber = document.querySelector('[name="accountNumber"]').value;
        let accountName = document.querySelector('[name="accountName"]').value;
        let groupName = document.querySelector('[name="groupName"]').value;

        alert(accountNumber)
        alert(accountName)
        alert(groupName)

        axios.post('http://127.0.0.1:8000/api/coa/store', {
                accountNumber: accountNumber,
                accountName: accountName,
                groupName: groupName
            })
            .then(response => {
                console.log(response.data);
                location.reload();
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>
@endsection