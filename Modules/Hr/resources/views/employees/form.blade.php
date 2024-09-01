<div class="form-group">
    <label for="first_name">First Name</label>
    <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name', $employee->first_name ?? '') }}" required>
</div>
<div class="form-group">
    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name', $employee->last_name ?? '') }}" required>
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $employee->email ?? '') }}" required>
</div>
<div class="form-group">
    <label for="phone_number">Phone Number</label>
    <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ old('phone_number', $employee->phone_number ?? '') }}">
</div>
<div class="form-group">
    <label for="hire_date">Hire Date</label>
    <input type="date" name="hire_date" class="form-control" id="hire_date" value="{{ old('hire_date', $employee->hire_date ?? '') }}" required>
</div>
<div class="form-group">
    <label for="job_title">Job Title</label>
    <input type="text" name="job_title" class="form-control" id="job_title" value="{{ old('job_title', $employee->job_title ?? '') }}" required>
</div>
<div class="form-group">
    <label for="department">Department</label>
    <input type="text" name="department" class="form-control" id="department" value="{{ old('department', $employee->department ?? '') }}">
</div>
<div class="form-group">
    <label for="salary">Salary</label>
    <input type="number" name="salary" class="form-control" id="salary" value="{{ old('salary', $employee->salary ?? '') }}">
</div>
<div class="form-group">
    <label for="manager_id">Manager</label>
    <select name="manager_id" class="form-control" id="manager_id">
        <option value="">Select Manager</option>
        @foreach ($managers as $manager)
            <option value="{{ $manager->id }}" {{ old('manager_id', $employee->manager_id ?? '') == $manager->id ? 'selected' : '' }}>
                {{ $manager->first_name }} {{ $manager->last_name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select name="status" class="form-control" id="status">
        <option value="Active" {{ old('status', $employee->status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{ old('status', $employee->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
