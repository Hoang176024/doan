<div class="card-body">
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" value="{{old('name', $customerGroup->name)}}" placeholder="Enter name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="exampleInputEmail1" value="{{old('description', $customerGroup->description)}}" placeholder="Enter description">
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>