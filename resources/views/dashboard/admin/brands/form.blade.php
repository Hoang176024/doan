<div class="card-body">
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" value="{{old('name', $brand->name)}}" placeholder="Enter name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Picture</label>
        @if ($brand->photo)
        <div>
            <img src="/{{$brand->photo}}" width="120px" class="img-thumbnail" alt="photo">
        </div>
        @endif
        <div class="custom-file">
            <input type="file" name="photo" class="custom-file-input @error('photo') is-invalid @enderror" value="{{old('photo', $brand->photo)}}" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        </div>
    </div>
</div>