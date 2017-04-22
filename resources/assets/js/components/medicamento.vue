<script language= "text/javascript">
    export default{
        data(){
            return {
                medicamento: {
                    simpas: '',
                    nomecomercial: '',
                    formafarmaceutica: '',
                    conteudo: '',
                    quantidade: '',
                    unidade: '',
                    substancias: [],
                },
            }
        },

        methods: {
            addSubstancia(){
                this.medicamento.substancias.push({
                    idsubstancia: this.idsubstancia,
                    quantidadedose: this.quantidadedose,
                    unidadedose: this.unidadedose
                 });
                this.idsubstancia = '';
                this.quantidadedose = '';
                this.unidadedose = '';
                $("#substancia").modal('hide')
            },
            removeSubstancia(substancia) {
                var index = this.clinica.substancias.indexOf(substancia)
                if(index > -1){
                    this.clinica.substancias.splice(index, 1)                  
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
                   <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Código SIMPAS:</strong>
                    <input type="text" id="codigosimpas" name="codigosimpas" class="form-control" placeholder = "Digite o código simpas" v-model="medicamento.simpas"></input>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome Comercial:</strong>
                    <input type="text" id="nomecomercial" name="nomecomercial" class="form-control" placeholder = "Digite o nome comercial" v-model="medicamento.nomecomercial"></input>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Forma farmacêutica:</strong>
                    
                    <select id="idformafarmaceutica" name="idformafarmaceutica" class="form-control" v-model="medicamento.formafarmaceutica">
                    <option value="1">Forma Famrcaêutica 01</option>    
                    </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Conteúdo:</strong>
                    <select id="nomeconteudo" name="nomeconteudo" class="form-control" v-model="medicamento.conteudo">
                        <option value="0">frasco</option>
                        <option value="1">FA (frasco ampola)</option>
                        <option value="2">AMP (ampola)</option>
                        <option value="3">Caixa</option>
                        <option value="4">Envelope</option>
                        <option value="5">Tubo</option>
                        <option value="6">Bolsa</option>
                        <option value="7">Pote</option>
                        <option value="8">Caixa</option>
                      </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Quantidade:</strong>
                       <input type="text" id="quantidadeconteudo" name="quantidadeconteudo" class="form-control" placeholder = "Digite a quantidade do medicamento" v-model="medicamento.quantidade" ></input>
                 </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Unidade de medida:</strong>
                    <select id="unidadeconteudo" name="unidadeconteudo" class="form-control" placeholder = "--Selecione--" v-model="medicamento.unidade">
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
                        <strong>Total de substâncias:</strong>
                        {{medicamento.substancias.length}}
                        <a class="btn btn-default" style="border-radius: 45%; margin-left: 2%;" data-toggle="modal" data-target="#substancia" title="Adicionar substância"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                <br>
                <div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                    <h4><center><b>Substâncias</b></center></h4>
                        <div class="box-body">
                            <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
                                <table id="table" class="table table-condensed table-bordered table-hover dataTable" role="grid">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nome</th>
                                            <th class="text-center">Observação</th>
                                            <th width="3%" class="text-center">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for = "substancia in medicamento.substancias">
                                            <td>{{substancia.substancia}}</td>
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
        </div>
        <div class="modal fade" id="substancia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Cadastrar Substância</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                            <div class="row">
                                <div class="box-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Substancia ativa:</strong>
                                            <select id="unidadeconteudo" name="unidadeconteudo" class="form-control" placeholder = "--Selecione--" v-model="idsubstancia">
                                                <option value="0">SA1</option>
                                                <option value="1">SA2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Dose:</strong>
                                            <input type="text" title="dose" class="form-control" style="height: 100px" v-model="quantidadedose"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                        <select id="unidadeconteudo" name="unidadeconteudo" class="form-control" placeholder = "--Selecione--" v-model="unidadedose">
                                            <option value="0">mcg</option>
                                            <option value="1">mg</option>
                                            <option value="2">g</option>
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
</template>

<style scoped=""></style>

