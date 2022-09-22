{{ csrf_field() }}
<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description">Description</label>
    <input type="text" name="description" id="description" class="form-control" value="{{ old('description') ?: $transaction->description }}">
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
    <label for="amount">Amount</label>
    <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') ?: $transaction->amount }}">
</div>
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
    <label for="category_id">Category</label>
    <select name="category_id" class="form-control">
        <option value=""></option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id === (intval(old('category_id') ?: $transaction->category_id)) ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<button type="submit" class="btn btn-success">{{ isset($buttonText) ? $buttonText : 'Save' }}</button>