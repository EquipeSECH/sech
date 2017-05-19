<script language= "text/javascript">
    export default{
        
        props: ['ff', 'sa'],
        
        data(){
            return {
                medicamento: {
                    simpas: '',
                    nomecomercial: '',
                    conteudo: '',
                    formafarmaceutica: '',
                    quantidade: '',
                    unidade: '',
                    substancias: [],        
                },
                formasfarmaceuticas: [],
                substanciasativas: [],
            }
        },
        
        mounted(){
                this.formasfarmaceuticas = JSON.parse(this.ff);
                this.substanciasativas = JSON.parse(this.sa);
        },
        methods: {
            addSubstancia(){
                this.medicamento.substancias.push({
                    substancia: this.substancia,
                    quantidadedose: this.quantidadedose,
                    unidadedose: this.unidadedose,    
                 });
 console.log(this.medicamento.substancias);
                this.substancia = '';
                this.quantidadedose = '';
                this.unidadedose = '';
                $("#substancia").modal('hide');
            },
            removeSubstancia(substancia) {
                var index = this.medicamento.substancias.indexOf(substancia)
                if(index > -1){
                    this.medicamento.substancias.splice(index, 1)                  
                }
            },
            adicionar(){
                this.$http.post('/medicamento/create', this.medicamento).then(response => {
                    swal({
                        title: "Salvo!",
                        text: "Medicamento cadastrado com sucesso!",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                   },
                   function(){
                        location.href = "../../medicamento";
                   }); 
                }).catch(response => {
                    console.log('Erro:' + response);
                });
            }
        }
    }
</script>

<template>
    <div>
        <div class="row">
            <div class="box-body">   
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>SIMPAS:</strong>
                        <input id="simpas" type="text" name="simpas" class="form-control" v-model="medicamento.simpas" placeholder="Digite o código simpas">
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Nome comercial:</strong>
                        <input id="nomecomercial" type="text" name="nomecomercial" class="form-control" v-model="medicamento.nomecomercial" placeholder="Digite o nome comercial">
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Forma farmacêutica:</strong> 
                            <select id="formafarmaceutica" name="formafarmaceutica" class="form-control" v-model="medicamento.formafarmaceutica">
                                <option v-for = "forma in formasfarmaceuticas" v-bind:value=forma.id>{{forma.nome}}</option>
                            </select>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Conteúdo:</strong>
                        <select id="nomeconteudo" name="nomeconteudo" class="form-control" v-model="medicamento.conteudo">
                            <option value="0">Frasco</option>
                            <option value="1">FA (frasco ampola)</option>
                            <option value="2">AMP (ampola)</option>
                            <option value="3">Caixa</option>
                            <option value="4">Envelope</option>
                            <option value="5">Tubo</option>
                            <option value="6">Bolsa</option>
                            <option value="7">Pote</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Quantidade:</strong>
                        <input id="quantidade" type="text" name="quantidade" class="form-control" v-model="medicamento.quantidade">
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Unidade de medida:</strong>
                        <select id="unidade" name="unidade" class="form-control" placeholder = "--Selecione--" v-model="medicamento.unidade">
                            <option value="0">mcg</option>
                            <option value="1">mg</option>
                            <option value="2">g</option>
                            <option value="3">UI</option>
                            <option value="4">unidades</option>
                            <option value="5">mg/g</option>
                            <option value="6">UI/g</option>
                            <option value="7">mEq/mL</option>
                            <option value="8">mg/gota</option>
                            <option value="9">mcg/mL</option>
                            <option value="10">UI/mL</option>
                            <option value="11">mEq</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Total de substâncias ativas:</strong>
                        {{medicamento.substancias.length}}
                        <a class="btn btn-default" style="border-radius: 45%; margin-left: 2%;" data-toggle="modal" data-target="#substancia" title="Adicionar substância ativa"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                <br>
                <div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                    <h4><center><b>Substâncias ativas</b></center></h4>
                        <div class="box-body">
                            <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
                                <table id="table" class="table table-condensed table-bordered table-hover dataTable" role="grid">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Substância</th>
                                            <th class="text-center">Quantidade</th>
                                            <th class="text-center">Unidade</th>
                                            <th width="3%" class="text-center">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for = "substancia in medicamento.substancias">
                                            <!--<td>{{substancia.substancia}}</td>-->                                            
                                            <td>
                                                <div v-for="substancia2 in substanciasativas" v-if="(substancia.substancia === substancia2.id)">
                                                    {{substancia2.nome}}
                                                </div>                            
                                            </td>
                                            <td>{{substancia.quantidadedose}}</td>
                                            <td>{{substancia.unidadedose}}</td>
                                            <td>             
                                                <center>
                                                <a class="btn btn-default"  @click="removeSubstancia(substancia)"><i class="fa fa-trash"></i></a>
                                                </center>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                </div>
                <div class="pull-right" style="margin-right: 1%;">
                    <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar" @click="adicionar"><i class="fa fa-save"></i></button>
                </div>
                <div class="pull-right" style="margin-right: 1%;">
                    <a class="btn btn-default" data-toggle="tooltip"  title="Voltar" onclick="window.history.go(-1);"> 
                        <i class="fa  fa-mail-reply"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="modal fade" id="substancia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Cadastrar substâncias ativas</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                            <div class="row">
                                <div class="box-body">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Substância ativa:</strong>
                                             <select id="substancia" name="substancia" class="form-control" v-model="substancia">
                                                <option v-for = "substancia in substanciasativas" v-bind:value=substancia.id>{{substancia.nome}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Quantidade:</strong>
                                            <input id="quantidadedose" type="text" name="quantidadedose" class="form-control" v-model="quantidadedose">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Unidade de medida:</strong>
                                            <select id="unidadedose" name="unidadedose" class="form-control" placeholder = "--Selecione--" v-model="unidadedose">
                                                <option value="0">mcg</option>
                                                <option value="1">mg</option>
                                                <option value="2">g</option>
                                                <option value="3">UI</option>
                                                <option value="4">unidades</option>
                                                <option value="5">mg/g</option>
                                                <option value="6">UI/g</option>
                                                <option value="7">mEq/mL</option>
                                                <option value="8">mg/gota</option>
                                                <option value="9">mcg/mL</option>
                                                <option value="10">UI/mL</option>
                                                <option value="11">mEq</option>
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" @click="addSubstancia">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
</div>
</template>

<style scoped=""></style>