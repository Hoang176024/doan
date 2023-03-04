<div class="card-body">
    <div class="form-group">
        <label for="exampleInputEmail1">Tên</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" value="{{old('name', $tax->name)}}" placeholder="Enter name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputEmail2">Tỉ lệ</label>
        <input type="text" name="rate" class="form-control @error('rate') is-invalid @enderror" id="exampleInputEmail2" value="{{old('rate', $tax->rate)}}" placeholder="Enter rate">
        @error('rate')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>