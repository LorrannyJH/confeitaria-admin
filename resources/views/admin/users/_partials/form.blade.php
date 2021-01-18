<div class="row">
    <div class="form-group col-4">
        <input type="text" placeholder="usuário" class="form-control" name="user[name]" value="{{old('user.name',$user->name ?? '')}}">
    </div>
    <div class="form-group col-4">
        <input type="email" placeholder="email" class="form-control" name="user[email]" value="{{old('user.email',$user->email ?? '')}}">
    </div>
    <div class="form-group col-4">
        <select class="form-control" name="user[role_id]">
        @foreach($roles as $role)
            <option {{isset($user) && $user->role_id == $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
        @endforeach
        </select>
    </div>
    <div class="form-group col-6">
        <input type="password" placeholder="senha" class="form-control" name="user[password]">
    </div>
    <div class="form-group col-6">
        <input type="password" placeholder="confirmar senha" class="form-control" name="user[password_confirmation]">
    </div>
</div>