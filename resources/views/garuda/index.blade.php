@section('title', 'Master Of Item')
@extends('layouts.main')

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
            <h4 class="fw-bold py-1 mb-2"><span class="text-muted fw-light">Test Programming /</span> Input</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4 border">
                    <div class="card-title fw-bold fs-5">Soal 1</div>
                    <div class="modal-body">
                        <form id="form-data">
                            @csrf
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <label for="exampleFormControlInput1" class="form-label">Input :</label>&nbsp;&nbsp;
                                    <input type="text" x-model="keyWord" name="keyWord" id="keyWord"
                                        placeholder="Enter Character" class="form-control" />&nbsp;&nbsp;
                                    <button class="btn btn-primary btn-search" type="button" title="Search Value">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </div>
                            </div><br><br>
                            <div class="col-sm-5">
                                <label for="exampleFormControlInput1" class="form-label">Output :</label>&nbsp;&nbsp;
                                <span id="nilai_char"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4 border">
                    <div class="card-title fw-bold fs-5">Soal 3</div>
                    <div class="modal-body">
                        <form id="form-data">
                            @csrf
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <label for="exampleFormControlInput1" class="form-label">Input Target:</label>&nbsp;&nbsp;
                                    <input type="number" id="targetVolume" class="form-control" placeholder="Masukkan Volume Target (X)">
                                    <button class="btn btn-primary" type="button" title="Search Value" onclick="calculateBuckets()">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </div>
                            </div><br><br>
                            <div class="col-sm-5">
                                <span id="result"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.btn-search').off('click').on('click', function() {
            var sequence = $('#keyWord').val();
            var result = generateNumber(sequence);
            $('#nilai_char').text(result);
        });

        function generateNumber(pattern) {
            let stack = [];
            let result = '';
            let nextNumber = 1;

            if (pattern.length > 8 || !/^[MN]+$/.test(pattern)) {
                return 'Invalid pattern';
            }

            for (let i = 0; i <= pattern.length; i++) {
                stack.push(nextNumber);
                nextNumber++;

                // Jika pola berakhir atau pola selanjutnya adalah N (meningkat)
                if (i === pattern.length || pattern[i] === 'N') {
                    while (stack.length > 0) {
                        result += stack.pop();
                    }
                }
            }

            return result;
        }

        function calculateBuckets() {
            const primeBuckets = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29]; // Bilangan prima antara 0 sampai 30 liter
            const targetVolume = parseInt(document.getElementById('targetVolume').value);
            if (isNaN(targetVolume) || targetVolume < 100 || targetVolume > 10000000) {
                alert('Masukkan volume target yang valid antara 100 hingga 10.000.000');
                return;
            }

            const result = minBuckets(primeBuckets, targetVolume);
            document.getElementById('result').innerHTML = `Detail: <br>`;
            for (let i = 0; i < primeBuckets.length; i++) {
                document.getElementById('result').innerHTML += `Botol ${primeBuckets[i]} = ${result[i]} botol<br>`;
            }
            document.getElementById('result').innerHTML += `Total = ${result.reduce((acc, cur) => acc + cur, 0)} botol`;
        }

        function minBuckets(primeBuckets, X) {
            primeBuckets.sort((a, b) => a - b); // Urutkan ember dari yang terkecil
            const n = primeBuckets.length;
            const dp = new Array(X + 1).fill(Infinity);
            const dpBuckets = new Array(X + 1).fill(null);

            dp[0] = 0;

            for (let i = 1; i <= X; i++) {
                for (let j = 0; j < n; j++) {
                    if (primeBuckets[j] <= i && dp[i - primeBuckets[j]] + 1 < dp[i]) {
                        dp[i] = dp[i - primeBuckets[j]] + 1;
                        dpBuckets[i] = j; // Simpan index ember yang digunakan
                    }
                }
            }

            const result = new Array(n).fill(0);
            let idx = X;
            while (idx > 0) {
                const j = dpBuckets[idx];
                result[j]++;
                idx -= primeBuckets[j];
            }

            return result;
        }
    </script>
@endsection
