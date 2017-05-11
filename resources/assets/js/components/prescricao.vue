<script language= "text/javascript">
    export default{
        data(){
            return {
                paciente: '',
                nascimento: '',
                clinica: '',   
                leito: '',
                diag: '',
                admissao: '',
                prescricao: {
                    idinternacao: '',
                    idusuario: '',
                    dataprescricao: '',
                    historicoatual: '',
                    evolucao: '',
                    observacoesmedicas: '',
                    prescricaomedicamento: [],
                },
            }
        },
        methods: {
            addMed(){
                var id = $("#idmed").val()
                this.$http.post('../simpas', {id: id}).then(response => {
                    var med = $("#med").val();
                    this.prescricao.prescricaomedicamento.push({
                        simpas: response.data,
                        qtd: this.qtd,
                        med: med,
                        apr: this.apr,
                        obs: this.obs               
                    });
                    this.simpas = '';
                    this.qtd = '';
                    this.apr = '';
                    this.obs = '';
                    $("#med").val("");
                }).catch(response => {
                     
                });
            },
            removeMed(med) {
                var index = this.prescricao.prescricaomedicamento.indexOf(med)
                if(index > -1){
                    this.prescricao.prescricaomedicamento.splice(index, 1)                  
                }
            },
            adicionar(){
                this.$http.post('/clinica/create', this.clinica).then(response => {
                    swal({
                        title: "Salvo!",
                        text: "Clínica cadastrada com sucesso!",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                   },
                   function(){
                        location.href = "../../clinica";
                   }); 
                }).catch(response => {
                    console.log('Erro:' + response);
                });
            },
            buscar(){
                var rg = $("#rg").val();
                this.$http.post('../buscapaciente', {rg: rg}).then(response => {
                    $("#buscar").modal('hide')
                    this.paciente = response.data[0].nomecompleto;  
                    this.nascimento= response.data[0].nascimento;
                    this.clinica = response.data[0].nome;
                    this.leito = response.data[0].leito;
                    this.diag = response.data[0].descricao;
                    this.admissao = response.data[0].dataadmissao;
          
                }).catch(response => {
                     $("#buscar").modal('hide')
                    swal({
                        title: "Erro!",
                        text: "Não existe esse registro na base de dados",
                        type: "error"
                   });
                });
            }
        }
    }
    jQuery(function ($) {
        $("#rg").mask("99.999.999-99");
    });
    
    $(document).ready(function(){
        $('#med').autocomplete({
            source: '/autocomplete',
            minlength: 1,
            autoFocus:true,
            select: function(event, ui){
                $("#med").val(ui.item.value);
                $("#idmed").val(ui.item.id);
            }   
        });
    });
    $(document).on('click', '#add', function (){
        
    });

</script>

<template>
    <div>
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="box-body pad table-responsive"> 
                    <div class="col-xs-10 col-sm-10 col-md-10">
                        <div class="form-group">
                            <label for="paciente">Paciente:</label>
                            <div class="input-group input-group-sm">
                                <input id="paciente" type="text" name="paciente" class="form-control" readonly="readonly" v-model="paciente">
                                <span class="input-group-btn">
                                  <button type="button" data-toggle="modal" data-target="#buscar" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <label for="nascimento">Data de nascimento:</label>
                            <input id="nascimento" type="text" name="nascimento" class="form-control" readonly="readonly" v-model="nascimento">
                        </div>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5">
                        <div class="form-group">
                            <label for="clinica">Clínica:</label>
                            <input id="clinica" type="text" name="clinica" class="form-control" readonly="readonly" v-model="clinica">
                        </div>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-md-1">
                        <div class="form-group">
                            <label for="leito">Leito:</label>
                            <input id="leito" type="text" name="leito" class="form-control" readonly="readonly" v-model="leito">
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="form-group">
                            <label for="diag">Diagnóstico:</label>
                            <input id="diag" type="text" name="diag" class="form-control" readonly="readonly" v-model="diag">
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <label for="admissao">Data de admissão:</label>
                            <input id="admissao" type="text" name="admissao" class="form-control" readonly="readonly" v-model="admissao">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="hist">Histórico da doença atual:</label>
                            <textarea id="hist" type="text" name="hist" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="evol">Evolução:</label>
                            <textarea id="evol" type="text" name="evol" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9">
                        <div class="form-group">
                            <label for="med">Medicamento:</label>
                            <input id="med" type="text" name="med" class="form-control">
                        </div>
                    </div>
                    <input id="idmed" type="hidden">
                    <div class="col-xs-1 col-sm-1 col-md-1">
                        <div class="form-group">
                            <label for="qtd">Quantidade:</label>
                            <input id="qtd" type="text" name="qtd" class="form-control" v-model="qtd">
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <label for="apr">Aprazamento:</label>
                            <select id="apr" type="text" name="apr" class="form-control">
                                <option value="12">2/2h</option>
                                <option value="6">4/4h</option>
                                <option value="4">6/6h</option>
                                <option value="3">8/8h</option>
                                <option value="2">12/12h</option>
                                <option value="1">24/24h</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-10">
                        <div class="form-group">
                            <label for="apr">Observação:</label>
                            <input id="obs" type="text" name="obs" class="form-control" v-model="obs">
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group"> 
                            <br>
                            <button type="button" class="btn btn-block btn-primary btn-flat" @click="addMed">Adicionar</button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <br>
                        <div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                            <h4><center><b>Descrição dos medicamentos</b></center></h4>
                                <div class="box-body">
                                    <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
                                        <table id="table" class="table table-condensed table-bordered table-hover dataTable" role="grid">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">SIMPAS</th>
                                                    <th width="2%" class="text-center">Quantidade</th>
                                                    <th class="text-center">Medicamento</th>
                                                    <th width="2%" class="text-center">Aprazamento</th>
                                                    <th class="text-center">Observação</th>
                                                    <th width="3%" class="text-center">Opções</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="medicamento in prescricao.prescricaomedicamento">
                                                    <td>{{medicamento.simpas}}</td>
                                                    <td>{{medicamento.qtd}}</td>
                                                    <td>{{medicamento.med}}</td>
                                                    <td>{{medicamento.apr}}</td>
                                                    <td>{{medicamento.obs}}</td>
                                                    <td>             
                                                        <center>
                                                        <a class="btn btn-default"  @click="removeMed(medicamento)"><i class="fa fa-trash"></i></a>
                                                        </center>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                        </div>
                    </div>
                    <div class="pull-right" style="margin-right: 1%;">
                        <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar" @click="adicionar"><i class="fa fa-save"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="buscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Buscar paciente</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                            <div class="row">
                                <div class="box-body">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>RG:</strong>
                                                <input type="text" name="rg" id="rg" class="form-control" v-model="rg" placeholder="Digite o rg do paciente para busca" onkeypress="return SomenteNumero(event)">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" @click="buscar">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped=""></style>
