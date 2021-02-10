<form action=" {{route('admin.comptes.store')}}" method="post">
    @method('put')
    {{csrf_field()}}
    <div class="modal-header">
        <h4 class="modal-title" >Ajouter un compte</h4>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value=" {{$demande->id}} ">
        <div class="row"> 
            <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="" class="col-md-6">Type d'utilistateur</label>
                        <div class="col-md-14">
                            <select name="type_user" id="" class="form-control" required>
                                    <option value="">Choisir type</option>
                                    <option value="Responsable Adm">Responsable Adm</option>
                                    <option value="Cadre">Cadre</option>
                                    <option value="Admin">Administrateur</option>                                                                       
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                @include('partials.form-group',[
                'title'=>__('Nom'),
                'type'=>'text',
                'name'=>'nom',
                'required'=>true
                ])
                @include('partials.form-group',[
                    'title'=>__('Prenoms'),
                    'type'=>'text',
                    'name'=>'prenoms',
                    'required'=>true
                    ])
                @include('partials.form-group',[
                    'title'=>__('Email'),
                    'type'=>'text',
                    'name'=>'email',
                    'required'=>true
                ])
                @include('partials.form-group',[
                    'title'=>__('Mot de passe'),
                    'type'=>'password',
                    'name'=>'mot_de_passe',
                    'required'=>true
                ])
    
            </div>   
                
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
