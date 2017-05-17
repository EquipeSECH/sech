<script language= "text/javascript">
    export default{

        props: ['cli', 'leitosdaclinica'],
        
        data(){
            return {
                clinica: {
                    id: '',
                    nome: '',
                    descricao: '',
                    leitos: [],
                },
            }
        },

        mounted(){
            this.clinica.id = JSON.parse(this.cli).id;
            this.clinica.nome = JSON.parse(this.cli).nome;
            this.clinica.descricao = JSON.parse(this.cli).descricao;
            this.clinica.leitos = JSON.parse(this.leitosdaclinica);
        },

        methods: {
            addLeito(){
                this.clinica.leitos.push({
                    leito: this.leito,
                    observacao: this.observacao               
                 });
                this.leito = '';
                this.observacao = '';
                $("#leito").modal('hide')
            },
            removeLeito(leito) {
                var index = this.clinica.leitos.indexOf(leito)
                if(index > -1){
                    this.clinica.leitos.splice(index, 1)                
                }
            },
            atualizar(){
                this.$http.patch('/clinica/' + this.clinica.id, this.clinica).then(response => {
                    swal({
                        title: "Salvo!",
                        text: "Clínica atualizada com sucesso!",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                   },
                   function(){
                        location.href = "../../clinica";
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
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome:</strong>
                        <input id="nome" type="text" name="nome" class="form-control" v-model="clinica.nome">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Descrição:</strong>  
                        <textarea name="descricao" placeholder="Descrição da clínica" class="form-control" style="height:100px" v-model="clinica.descricao"></textarea>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Total de leitos:</strong>
                        {{clinica.leitos.length}}
                        <a class="btn btn-default" style="border-radius: 45%; margin-left: 2%;" data-toggle="modal" data-target="#leito" title="Adicionar leito"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                <br>
                <div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                    <h4><center><b>Leitos</b></center></h4>
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
                                        <tr v-for = "leito in clinica.leitos">
                                            <td>{{leito.leito}}</td>
                                            <td>{{leito.observacao}}</td>
                                            <td>
                                                <center>
                                                <a class="btn btn-default"  @click="removeLeito(leito)"><i class="fa fa-trash"></i></a>
                                                </center>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                </div>
                <div class="pull-right" style="margin-right: 1%;">
                    <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Salvar" @click="atualizar"><i class="fa fa-save"></i></button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="leito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Cadastrar leito</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="box box-primary" style="margin-left: 2%; margin-right: 2%; width: 96%;">
                            <div class="row">
                                <div class="box-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Leito:</strong>
                                            <input type="text" name="leito" class="form-control" v-model="leito" placeholder="Digite o número do leito" onkeypress="return SomenteNumero(event)">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Observação:</strong>
                                            <textarea title="observacao" class="form-control" style="height: 100px" v-model="observacao"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" @click="addLeito">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
</div>
</template>

<style scoped=""></style>

