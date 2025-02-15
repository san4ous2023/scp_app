<!-- Filters -->
<!-- Toggle Switch -->
<div class="d-flex align-items-center mb-3">
    <label class="form-check-label me-2" for="toggleFilter">Show Filters</label>
    <input type="checkbox" class="form-check-input" id="toggleFilter">
</div>
<div id="filterRow" class="mb-3" style="display: none;">
    <form id="filterForm" action="{{ route('observation.index') }}" method="GET">
        <div class="row g-2">
            @can('view', auth()->user())
                <div class="col-sm-3">
                    <label for="userId" class="form-label">User ID</label>
                    <input type="text" class="form-control " id="userId" name="user_id" placeholder="Enter User ID">
                </div>
            @endcan
            <div class="col-sm-3">
                <label for="status" class="form-label">Status</label>
                <select name="status_id" class="form-select ">
                    <option value="">Select Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>
                            {{ $status->title ?? 'Unknown' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="startDate" name="start_date"
                       value="{{ old('start_date', request('start_date')) }}">
            </div>
            <div class="col-sm-3">
                <label for="endDate" class="form-label ">End Date</label>
                <input type="date" class="form-control" id="endDate" name="end_date"
                       value="{{ old('end_date', request('end_date')) }}">
            </div>
            {{--                <div class="col">--}}
            {{--                    <label for="updatedAt" class="form-label">Updated At</label>--}}
            {{--                    <input type="date" class="form-control" id="updatedAt" name="updated_at">--}}
            {{--                </div>--}}
        </div>
        <button type="submit" class="btn btn-primary mt-3">Search</button>
    </form>
</div>

{{--Open Close Filter block--}}
<script>
    document.getElementById('toggleFilter').addEventListener('change', function () {
        const filterRow = document.getElementById('filterRow');
        if (this.checked) {
            filterRow.style.display = 'block';
        } else {
            filterRow.style.display = 'none';
        }
    });
</script>

{{--search form submit--}}
<script>
    document.getElementById('filterForm').addEventListener('submit', function (e) {
        const inputs = this.querySelectorAll('input, select');
        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.name = ''; // Remove the name to exclude it from the query string
            }
        });
    });
</script>
{{--Saved toggle switch state--}}
<script>
    const toggleFilter = document.getElementById('toggleFilter');

    // Restore state from cookies
    document.addEventListener('DOMContentLoaded', () => {
        const cookieValue = document.cookie
            .split('; ')
            .find(row => row.startsWith('toggleFilter='))
            ?.split('=')[1];
        if (cookieValue === '1') {
            toggleFilter.checked = true;
            document.getElementById('filterRow').style.display = 'block';
        }
    });

    // Save state to cookies on toggle
    toggleFilter.addEventListener('change', () => {
        document.cookie = `toggleFilter=${toggleFilter.checked ? '1' : '0'}; path=/`;
        const filterRow = document.getElementById('filterRow');
        filterRow.style.display = toggleFilter.checked ? 'block' : 'none';
    });
</script>

<style>
    #filterRow {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
</style>
