<script>
  $(function (){
      //Initialize Select2 Elements
      $('.select2').select2({
        theme: "classic"
      })
      $('.select3').select2({
        
      })
          //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: "bootstrap4"
      })
      // $('#example1 thead tr')
      //   .clone(true)
      //   .addClass('filters')
      //   .appendTo('#example1 thead');
  
      // DataTable
      $("#example1").DataTable({
        
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "orderCellsTop": true,
        "fixedHeader": true,
        // "initComplete": function () {
        //   console.log('Contacts Table InitComplete.');
        //   var cursorPosition = ''

        //     var api = this.api();
 
        //     // For each column
        //     api
        //         .columns()
        //         .eq(0)
        //         .each(function (colIdx) {
        //             // Set the header cell to contain the input element
        //             var cell = $('.filters th').eq(
        //                 $(api.column(colIdx).header()).index()
        //             );
        //             var title = $(cell).text();
        //             $(cell).html('<input type="text" placeholder="' + title + '" />');
 
        //             // On every keypress in this input
        //             $(
        //                 'input',
        //                 $('.filters th').eq($(api.column(colIdx).header()).index())
        //             )
        //                 .off('keyup change')
        //                 .on('change', function (e) {
        //                     // Get the search value
        //                     $(this).attr('title', $(this).val());
        //                     var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
        //                     cursorPosition = this.selectionStart;
        //                     // Search the column for that value
        //                     api
        //                         .column(colIdx)
        //                         .search(
        //                             this.value != ''
        //                                 ? regexr.replace('{search}', '(((' + this.value + ')))')
        //                                 : '',
        //                             this.value != '',
        //                             this.value == ''
        //                         )
        //                         .draw();
        //                 })
        //                 .on('keyup', function (e) {
        //                     e.stopPropagation();
 
        //                     $(this).trigger('change');
        //                     $(this)
        //                         .focus()[0]
        //                         .setSelectionRange(cursorPosition, cursorPosition, 0);
        //                 });
        //         });
        // },



        "language": {
          "search": "Pesquisar",
          "zeroRecords": "Nenhum dado encontrado.",
          "infoEmpty": "A ver 0 até 0 de 0 registos",
          "infoFiltered": "(Filtrados _MAX_ registos)",
          "infoThousands": ".",
          "loadingRecords": "Carregando...",
          "info": "A ver _START_ até _END_ de _TOTAL_ registos",
          "paginate": {
            "first": '<i class="fas fa-angle-double-left"></i>',
            "last": '<i class="fas fa-angle-double-right"></i>',
            "previous": '<i class="fas fa-angle-left"></i>',
            "next": '<i class="fas fa-angle-right"></i>',
          },
          "buttons": {
            "pageLength": {
              _: "Mostrar %d linhas",
              '-1': "Todas as linhas"
            }
          },
          
          },
        
        //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)').addClass('filters').clone(true);
      
      
  });
  
    // PEGAR VALORES DO BOTÃO EDITAR PRODUTO
    $('#edit').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let title = button.data('mytitle')
      let price = button.data('myprice')
      let status = button.data('mystatus')
      let id = button.data('prodid')
      
        if(status == 1){
          $('#status_edit').prop('checked', true);
        }else{
          $('#status_edit').prop('checked', false);
        }
  
        $('#status_edit').on('change.bootstrapSwitch', function(e) {
          if(e.target.checked == true)
          {
            modal.find('.modal-body #status_edit').val(1)
          }
        });
  
      let modal = $(this)
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #nome').val(title)
      modal.find('.modal-body #valor').val(price)
      modal.find('.modal-body #status_edit').val(status)

      

    });
    
      // PEGAR VALORES DO BOTÃO EDITAR ETAPA
    $('#editetapa').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let title = button.data('mytitle')
      let produtoId = button.data('myidproduto')
      let status = button.data('mystatus')
      let id = button.data('etapaid')
      let allProduto = button.data('produto')
      let nome = button.data('nomeprodutos')

      $(".modal-body #selectProduto").find('option').remove()

      if(status == 1){
        $('#status_edit_Etapa').prop('checked', true);
      }else{
        $('#status_edit_Etapa').prop('checked', false);
      }
      $('#status_edit_Etapa').on('change.bootstrapSwitch', function(e) {
          if(e.target.checked == true)
          {
            modal.find('.modal-body #status_edit_Etapa').val(1)
          }
      });
      $(".modal-body #selectProduto").append($('<option>',{disabled: true, text:'Escolha uma etapa'})).change()
      // $(".modal-body #selectProduto").append($('<option>',{value:, text:nome}))

        allProduto.forEach(e =>{
          if(e.status == 1 && e.deletado == 0){

            $(".modal-body #selectProduto").append($('<option>',{value:e.id, text:e.name}))
          }
        }
        );

      let modal = $(this)
      
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #nome_etapa').val(title)
      modal.find('.modal-body #status_edit_Etapa').val(status)
      modal.find('.modal-body #selectProduto').val(produtoId).change()


      
    });

    // PEGAR VALORES DO BOTÃO CRIAR CAMPO
    $('#newCampo').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let etapa = button.data('myetapa')
      let idEtapa = ''
      let modal = $(this)

      $('#etapa_new').change(function(){ 
        idEtapa = $(this).val();
        
        etapa.forEach(e=>{
          if(e.id == idEtapa){
            $('#nome_produto').val(e.name)
            modal.find('.modal-body #id_produto').val(e.id_produto)
            
          }
        })
      });
      
    });
  
    // PEGAR VALORES DO BOTÃO EDITAR CAMPO
    $('#editcampo').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let title = button.data('mytitle')
      let idCampo = button.data('campoid')
      let nomeEtapa = button.data('nomeetapa') 
      let etapaId = button.data('etapaid')
      let etapas = button.data('myetapa')
      let nomeProduto = button.data('nomeproduto')
      let idProduto = button.data('idproduto')
      let status = button.data('mystatus')
 
      $(".modal-body #edit_etapa").find('option').remove()
      
        if(status == 1){
          $('#status_edit_campo').prop('checked', true);
        }else{
          $('#status_edit_campo').prop('checked', false);
        }
  
        $('#status_edit_campo').on('change.bootstrapSwitch', function(e) {
          if(e.target.checked == true)
          {
            modal.find('.modal-body #status_edit_campo').val(1)
          }
        });

        let modal = $(this)
      modal.find('.modal-body #id').val(idCampo)
      modal.find('.modal-body #edit_name_campo').val(title)
      modal.find('.modal-body #status_edit_campo').val(status)
      modal.find('.modal-body #edit_id_produto').val(idProduto)
      
      $(".modal-body #edit_etapa").append($('<option>',{disabled: true, text:'Escolha uma etapa'}))
      $(".modal-body #edit_etapa").append($('<option>',{value:etapaId, text:nomeEtapa})).change()

      $('#edit_etapa').change(function(){
        idEtapa = $(this).val();
        etapas.forEach(e=>{
          if(e.id == idEtapa){
            $('#edit_nome_produto').val(e.name)
            modal.find('.modal-body #id_produto').val(e.id_produto)
            
          }
        })
      });
        $('#edit_nome_produto').val(nomeProduto)
      etapas.forEach(e =>{
          if(e.status == 1 && e.deletado == 0){
            $(".modal-body #edit_etapa").append($('<option>',{value:e.id, text:e.nome_etapa}))
          }
        }
        );
      
      
      
    });

    // PEGAR VALORES DO BOTÃO EDITAR VARIAVEL
    $('#edititem').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let title = button.data('mytitle')
      let tipo = button.data('mytipo')
      let status = button.data('mystatus')
      let visivel = button.data('visivel')
      let id = button.data('etapaid')
      let idnumber = button.data('idnumber')
      let idswitch = button.data('switch')
      console.log(id)
      if(status == 1){
        $('#status_edit_variavel').prop('checked', true);
      }else{
        $('#status_edit_variavel').prop('checked', false);
      }
        $('#status_edit_variavel').on('change.bootstrapSwitch', function(e) {
          if(e.target.checked == true)
          {
            modal.find('.modal-body #status_edit_variavel').val(1)
          }
        });
        
      var modal = $(this)
      modal.find('.modal-body #edit_id_item' ).val(id)
      modal.find('.modal-body #edit-name_item').val(title)
      modal.find('.modal-body #status_edit_variavel').val(status)
      modal.find('.modal-body input[name="visivel_em"][value='+visivel+']').prop("checked", true);

      if(tipo == 'lista_select'|| tipo == 'lista_grade' ){
        modal.find('.modal-body #item_edit').val('select').change()
        document.getElementById("auxiliar-edit").style.display = 'none';
        document.getElementById("limite-edit").style.display = 'none';
        document.getElementById("switch-edit").style.display = 'none';
        document.getElementById("modo_edit").style.display = 'block';
        modal.find('.modal-body input[name="visualizacaoedit"][value='+tipo+']').prop("checked", true);
        // alert('Se mudar o tipo de variavel Lista a lista conectada a ela será apagado!')
        // toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      }
      else if(tipo == 'number'){
        modal.find('.modal-body #item_edit').val(tipo).change()
        idnumber.forEach(e =>{
          if(e.id == id){
            modal.find('.modal-body #placeholder-edit').val(e.placeholder)
            modal.find('.modal-body #edit-minimo').val(e.limite_min)
            modal.find('.modal-body #edit-maximo').val(e.limite_max)
          }

        })
        document.getElementById("auxiliar-edit").style.display = 'block';
        document.getElementById("limite-edit").style.display = 'block';
        document.getElementById("switch-edit").style.display = 'none';
        document.getElementById("modo_edit").style.display = 'none';

      }
      else if(tipo == 'switch'){
        modal.find('.modal-body #item_edit').val(tipo).change()
        idswitch.forEach(e =>{
          if(e.id == id){
            modal.find('.modal-body #edit-alternativa_um').val(e.alternativa_um)
            modal.find('.modal-body #edit-alternativa_dois').val(e.alternativa_dois)
          }
        })
        document.getElementById("auxiliar-edit").style.display = 'none';
        document.getElementById("limite-edit").style.display = 'none';
        document.getElementById("switch-edit").style.display = 'block';
        document.getElementById("modo_edit").style.display = 'none';

      }
      else if(tipo == 'checkbox'){
        modal.find('.modal-body #item_edit').val(tipo).change()
        document.getElementById("auxiliar-edit").style.display = 'none';
        document.getElementById("limite-edit").style.display = 'none';
        document.getElementById("switch-edit").style.display = 'none';
        document.getElementById("modo_edit").style.display = 'none';

      }
      else if(tipo == 'radio'){
        modal.find('.modal-body #item_edit').val(tipo).change()
        document.getElementById("auxiliar-edit").style.display = 'none';
        document.getElementById("limite-edit").style.display = 'none';
        document.getElementById("switch-edit").style.display = 'none';
        document.getElementById("modo_edit").style.display = 'none';

      }
      else if(tipo == 'date'){
        modal.find('.modal-body #item_edit').val(tipo).change()
        document.getElementById("auxiliar-edit").style.display = 'none';
        document.getElementById("limite-edit").style.display = 'none';
        document.getElementById("switch-edit").style.display = 'none';
        document.getElementById("modo_edit").style.display = 'none';

      }
      
    });

    $(".modal-body #tipo_item").on('change', function(e){
      
      if($(this).val()== 'checkbox'){
        document.getElementById("auxiliar").style.display = 'none';
        document.getElementById("limite-editar").style.display = 'none';
        document.getElementById("placeholder").value =''
        document.getElementById("minimoedit").value =''
        document.getElementById("maximoedit").value =''
      }
      if($(this).val()== 'radio'){
        document.getElementById("auxiliar").style.display = 'none';
        document.getElementById("limite-editar").style.display = 'none';
        document.getElementById("placeholder").value =''
        document.getElementById("minimoedit").value =''
        document.getElementById("maximoedit").value =''
      }
      if($(this).val()== 'number'){
        document.getElementById("auxiliar").style.display = 'block';
        document.getElementById("limite-editar").style.display = 'block';

      }
      if($(this).val()== 'select'){
        document.getElementById("auxiliar").style.display = 'none';
        document.getElementById("limite-editar").style.display = 'none';
        document.getElementById("placeholder").value =''
        document.getElementById("minimoedit").value =''
        document.getElementById("maximoedit").value =''
      }
        
    });

    //TIPO VARIAVEL EDITAR VARIAVEL
    $(".modal-body #item_edit").on('change', function(e){
      if($(this).val()== 'checkbox'){
        document.getElementById("auxiliar-edit").style.display = 'none';
        document.getElementById("limite-edit").style.display = 'none';
        document.getElementById("switch-edit").style.display = 'none';
        document.getElementById("modo_edit").style.display = 'none';
      }
      if($(this).val()== 'radio'){
        document.getElementById("auxiliar-edit").style.display = 'none';
        document.getElementById("limite-edit").style.display = 'none';
        document.getElementById("switch-edit").style.display = 'none';
        document.getElementById("modo_edit").style.display = 'none';
      }
      if($(this).val()== 'number'){
        document.getElementById("auxiliar-edit").style.display = 'block';
        document.getElementById("limite-edit").style.display = 'block';
        document.getElementById("switch-edit").style.display = 'none';
        document.getElementById("modo_edit").style.display = 'none';
      }
      if($(this).val()== 'select'){
        document.getElementById("auxiliar-edit").style.display = 'none';
        document.getElementById("limite-edit").style.display = 'none';
        document.getElementById("switch-edit").style.display = 'none';
        document.getElementById("modo_edit").style.display = 'block';
      }
      if($(this).val()== 'date'){
        document.getElementById("auxiliar-edit").style.display = 'none';
        document.getElementById("limite-edit").style.display = 'none';
        document.getElementById("switch-edit").style.display = 'none';
        document.getElementById("modo_edit").style.display = 'none';
      }
      if($(this).val()== 'switch'){
        document.getElementById("auxiliar-edit").style.display = 'none';
        document.getElementById("limite-edit").style.display = 'none';
        document.getElementById("switch-edit").style.display = 'block';
        document.getElementById("modo_edit").style.display = 'none';
      }
    })


      //CRIAR VARIAVEL
    $(".modal-body #item_novo").on('change', function(e){
      
      if($(this).val()== 'checkbox'){
        document.getElementById("auxiliar-novo").style.display = 'none';
        document.getElementById("limite-novo").style.display = 'none';
        document.getElementById("switch-novo").style.display = 'none';
        document.getElementById("modo_novo").style.display = 'none';
        document.getElementById("placeholder").value = '';
        document.getElementById("name_item").value = '';
        document.getElementById("alternativa_um").value = '';
        document.getElementById("alternativa_dois").value = '';
        document.getElementById("minimo").value = '';
        document.getElementById("maximo").value = '';
      }
      if($(this).val()== 'radio'){
        document.getElementById("auxiliar-novo").style.display = 'none';
        document.getElementById("limite-novo").style.display = 'none';
        document.getElementById("switch-novo").style.display = 'none';
        document.getElementById("modo_novo").style.display = 'none';
        document.getElementById("placeholder").value = '';
        document.getElementById("name_item").value = '';
        document.getElementById("alternativa_um").value = '';
        document.getElementById("alternativa_dois").value = '';
        document.getElementById("minimo").value = '';
        document.getElementById("maximo").value = '';
      }
      if($(this).val()== 'number'){
        document.getElementById("auxiliar-novo").style.display = 'block';
        document.getElementById("limite-novo").style.display = 'block ';
        document.getElementById("switch-novo").style.display = 'none';
        document.getElementById("modo_novo").style.display = 'none';
        document.getElementById("placeholder").value = '';
        document.getElementById("name_item").value = '';
        document.getElementById("alternativa_um").value = '';
        document.getElementById("alternativa_dois").value = '';
        document.getElementById("minimo").value = '';
        document.getElementById("maximo").value = '';
      }
      if($(this).val()== 'select'){
        document.getElementById("auxiliar-novo").style.display = 'none';
        document.getElementById("limite-novo").style.display = 'none';
        document.getElementById("switch-novo").style.display = 'none';
        document.getElementById("modo_novo").style.display = 'block';
        document.getElementById("placeholder").value = '';
        document.getElementById("name_item").value = '';
        document.getElementById("alternativa_um").value = '';
        document.getElementById("alternativa_dois").value = '';
        document.getElementById("minimo").value = '';
        document.getElementById("maximo").value = '';
      }
      if($(this).val()== 'date'){
        document.getElementById("auxiliar-novo").style.display = 'none';
        document.getElementById("limite-novo").style.display = 'none';
        document.getElementById("switch-novo").style.display = 'none';
        document.getElementById("modo_novo").style.display = 'none';
        document.getElementById("placeholder").value = '';
        document.getElementById("name_item").value = '';
        document.getElementById("alternativa_um").value = '';
        document.getElementById("alternativa_dois").value = '';
        document.getElementById("minimo").value = '';
        document.getElementById("maximo").value = '';
      }
      if($(this).val()== 'switch'){
        document.getElementById("auxiliar-novo").style.display = 'none';
        document.getElementById("limite-novo").style.display = 'none';
        document.getElementById("switch-novo").style.display = 'block';
        document.getElementById("modo_novo").style.display = 'none';
        document.getElementById("placeholder").value = '';
        document.getElementById("name_item").value = '';
        document.getElementById("alternativa_um").value = '';
        document.getElementById("alternativa_dois").value = '';
        document.getElementById("minimo").value = '';
        document.getElementById("maximo").value = '';
      }
    });

      // PEGAR VALORES DO BOTÃO EDITAR LISTA
    $('#editsubitem').on('show.bs.modal', function(event){
        let button = $(event.relatedTarget)
        let title = button.data('mytitle')
        let status = button.data('mystatus')
        let img = button.data('myimg')
        let id = button.data('subetapaid')
        let tipo = button.data('tipoacao')
        let acao = button.data('myacao')

        let min_max = acao.toString().includes("-")
        console.log(min_max)
    
        

        if(status == 1){
          $('#status_edit_lista').prop('checked', true);
        }else{
          $('#status_edit_lista').prop('checked', false);
        }
        
  
        $('#status_edit_lista').on('change.bootstrapSwitch', function(e) {
          if(e.target.checked == true)
          {
            modal.find('.modal-body #status_edit_lista').val(1)
          }
        });
        let modal = $(this)
        if(tipo == 'desc'){
          document.getElementById("desconto_edit").style.display = 'block';
          document.getElementById("acrescimo_edit").style.display = 'none';
          modal.find('.modal-body #percent_desconto_edit').val(acao)
          modal.find('.modal-body #item_subitem_edit').val(tipo).change()
        }
        if(tipo == 'add'){
          document.getElementById("acrescimo_edit").style.display = 'block';
          document.getElementById("desconto_edit").style.display = 'none';
          modal.find('.modal-body #percent_acrescimo_edit').val(acao)
          modal.find('.modal-body #item_subitem_edit').val(tipo).change()
        }
        if(min_max == true){
          let tipo_min = acao.substring(acao.lastIndexOf("-"), -1)
          let tipo_max = acao.substring(acao.lastIndexOf("-") +1)

          if(tipo == 'medidas'){
          document.getElementById("limite-subitem_edit").style.display = 'block';
          document.getElementById("desconto_edit").style.display = 'none';
          document.getElementById("acrescimo_edit").style.display = 'none';
          modal.find('.modal-body #percent_acrescimo_edit').val(acao)
          modal.find('.modal-body #minimo_sub_edit').val(tipo_min)
          modal.find('.modal-body #maximo_sub_edit').val(tipo_max)
          modal.find('.modal-body #item_subitem_edit').val(tipo).change()
        }
        }

        if(img.indexOf("#") === 0){
          document.getElementById("exibe_cor_edit").style.display = 'block';
          modal.find('.modal-body #cor_escolher_edit').val(img)
        }
        if(img.indexOf("#") !== 0){
          
          let url = '/AdminLTE/dist/img/listas/'+img
          document.getElementById("exibe_image_edit").style.display = 'block';
          document.getElementById('imageDiv')
          .innerHTML = '<img src="'+url+'" />';
        }
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #nome_lista').val(title)
        // modal.find('.modal-body #cor_escolher_edit').val(img)
        modal.find('.modal-body .status').val(status)
        modal.find('.modal-body #status_edit_lista').val(status)
        modal.find('.modal-body #percent_desconto_edit').val(acao)
        
        
    });

    // PEGAR VALORES DO BOTÃO INSERIR IMAGEM
    $(".modal-body #cor_radio").on('change', function(e){
      if($(this).val()== 'on'){
        document.getElementById("exibe_cor").style.display = 'block';
        document.getElementById("exibe_image").style.display = 'none';
      }        
    });

    // PEGAR VALORES DO BOTÃO INSERIR IMAGEM
    $(".modal-body #imagem_radio").on('change', function(e){
      if($(this).val()== 'on'){
        document.getElementById("exibe_image").style.display = 'block';
        document.getElementById("exibe_cor").style.display = 'none';
      }        
    });
  
      // PEGAR VALORES DO BOTÃO DUPLICAR
    $('#duplicar').on('show.bs.modal', function(event){
        let button = $(event.relatedTarget)
        let campos = button.data('campoid')
        let id = button.data('itemid')
        let lista_campos = [];
        if(campos.length > 0){
          lista_campos = campos.split(',')
        }else{
          lista_campos[0] = campos
        }
        let modal = $(this)
        modal.find('.modal-body input.duplica').prop("checked", false);
        modal.find('.modal-body #id').val(id)
        lista_campos.forEach(lista)
        function lista(item){
          modal.find('.modal-body #campo_' + item).val(item).prop("checked", true).prop("disabled",true);
        }
    });
  
     // PEGAR VALORES DO BOTÃO EDITAR PEDIDO
    $('#editpedido').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let status = button.data('mystatus')
      let id = button.data('pedidoid')
        if(status == 0)
        {
          $('#cancelado').prop('checked', true);
        }else if(status == 2)
        {
          $('#aprovado').prop('checked', true);
        }else if(status == 3)
        {
          $('#analise').prop('checked', true);
        }else if(status == 1)
        {
          $('#cancelado').prop('checked', false);
          $('#aprovado').prop('checked', false);
          $('#analise').prop('checked', false);
        }
        $('#cancelado').on('change.bootstrapSwitch', function(e) {
          if(e.target.checked == true)
          {
            modal.find('.modal-body #cancelado').val(0)
          }
        });
        $('#aprovado').on('change.bootstrapSwitch', function(e) {
          if(e.target.checked == true)
          {
            modal.find('.modal-body #aprovado').val(2)
          }
        });
        $('#analise').on('change.bootstrapSwitch', function(e) {
          if(e.target.checked == true)
          {
            modal.find('.modal-body #analise').val(3)
          }
        });
      let modal = $(this)
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body .status').val(status)
    });
  
    function proximo(before, next) {
      let antes = 'id-' + before
      let depois = 'id-' + next
      if (before)
      {
        let tablink1 = document.getElementById('id_' + before).classList.toggle('active')
        let tab1 = document.getElementById(antes).classList.remove('active')
      }
      if (next)
      {
        let tablink2 = document.getElementById('id_' + next).classList.toggle('active')
        let tab2 = document.getElementById(depois).classList.add('active')
      }
    }



    //SALVAR NO BANCO OS DADOS DIGITADOS  
    function finalizar() {
      let _token = $('meta[name="_token"]').attr('content');
      $.ajaxSetup({
        headers:
        {
          'X-CSSRF-TOKEN': _token
        }
      });
  
      var form = document.form;
      var values = {};
      var id_produto = {}

      $('.activeInput').each(function () {
        if ( $(this).is(':text') || $(this).is(':checked') || $(this).is('select')   ) {
          values[this.id] = $(this).val();
        }
        if($(this).is(':hidden') ){
          id_produto['id_produto'] = $('#id_produto').val();
          id_produto['status'] = $('#status').val();
        }
      });
      
      let url = "{{ route('Painel.Pedido.store') }}"
  
      // $.ajax({
      //   url: url,
      //   type: 'post',
      //   data: {
      //     values,
      //     id_produto,
      //     _token: "{{ csrf_token() }}"
      //   },
      //   // dataType: 'JSON',
      //   success: function(data){
      //     console.log(data)
      //   }, 
      //   error: function(){
      //   alert("Erro de Comunicação com o Banco de Dados ");
      //   }
      // });
      // window.history.back();
    }

    //MASK TEXT
    let id_numero = []
    var timeout = null
    var variavelAtual = {};
    var allDigitado = [];
    var id_relacao = ''
    var formulasIds = []

    // DADOS NO FORM PARA MANIPULARA FORMULAS
    function myFunction(id_produto, id, min, max, id_sub)
    {
      
      $('.medidas').mask("999999", {reverse: true});

      var messagem = document.getElementById('messagem');
      messagem.style.display = 'none';

      var valor = document.getElementById(id);

      clearTimeout(timeout);
      timeout = setTimeout(async function() {

        let digitos = valor.value;
        id_numero.push(valor.id);
        variavelAtual = "[" + id + "]";
        
        if(digitos == null){
              digitos = 0
        }
        if(parseFloat(digitos) < min || parseFloat(digitos) > max){

          if(messagem.style.display =='none') {
              valor.focus();
              valor.style.borderColor = 'red';
              messagem.style.display = 'block';
          }else{
              messagem.style.display = 'none';
          }
            messagem.innerHTML = '<div><i class="fa-solid fa-triangle-exclamation mr-2"></i> Fora do limite de produção.</div> '
            
        } else {
          valor.blur();
          valor.style.borderColor = '';

          let url = "{{ route('Painel.Pedido.relacionar') }}"
          await $.ajax({
            url: url,
            type: 'post',
            data: {
              variavelAtual,
              id_produto,
              _token: "{{ csrf_token() }}"
            },
            success: function(data){

              Object.keys(data.relacao).forEach(e =>{
                formulas =  data.relacao[e].formula_associacao;
                id_relacao = data.relacao[e].id_associacao;

                var arrayFormulas = formulas.replaceAll('plus', '$')
                                        .replaceAll('minus','$')
                                        .replaceAll('times','$')
                                        .replaceAll('Popen','$')
                                        .replaceAll('Pclosed','$')
                                        .split('$');
                    
                var semVazioArray =arrayFormulas.filter(function (i) { return i; });
                formulasIds.push([formulas, id_relacao]);
                      
              });

            }, 
            error: function(){
              alert("Erro de Comunicação com o Banco de Dados ");
            }
          });

          var allSemRepetir = formulasIds.map(JSON.stringify).filter((e,i,a) => i === a.indexOf(e)).map(JSON.parse)

          allSemRepetir.forEach(function(e){
            allDigitado.forEach(function(dig){
              if(e[0].indexOf(variavelAtual) > -1){
                var count = e[0].toString();
                if( count.length === variavelAtual.length ){
                    // aqui meus ids tranformados em array
                  var myIds = e[0].replaceAll('plus', '$')
                                  .replaceAll('minus', '$')   
                                  .replaceAll('times','$')
                                  .replaceAll('Popen','$')
                                  .replaceAll('Pclosed','$')
                                  .split('$');

                    // aqui transformo minha formulado do banco
                  var formula = e[0].replace( 'plus', '+')
                                    .replace('minus', '-')
                                    .replace('times', '*')
                                    .replace('Popen', '(')
                                    .replace('Pclosed', ')');

                            // com os ids consigo chamar os valores
                  myIds.forEach(function(e){
                    formula= formula.replace(e, $(".activeInput[data-id='"+ e +"']").val())
                  });
                            
                    $(".activeInput[data-id='"+ e[1] +"']").val(eval(formula))

                } else if(e[0].indexOf(dig) > -1){
                  if( dig !== variavelAtual){
                      // aqui meus ids tranformados em array
                    var myIds = e[0].replaceAll('plus', '$')
                                    .replaceAll('minus','$')
                                    .replaceAll('times','$')
                                    .replaceAll('Popen','$')
                                    .replaceAll('Pclosed','$')
                                    .split('$');

                      // aqui transformo minha formulado do banco
                    var formula = e[0].replace( 'plus', '+')
                                      .replace('minus', '-')
                                      .replace('times', '*')
                                      .replace('Popen', '(')
                                      .replace('Pclosed', ')')

                    myIds = myIds.filter(function(i) { return i; });

                    // com os ids consigo chamar os valores
                    var salvaNum = []
                    myIds.forEach(function(e){
                      var valorInput = $(".activeInput[data-id='"+ e +"']").val()
                      formula = formula.replace(e, valorInput)
                      if( valorInput !== '' ) {
                        salvaNum.push(valorInput)
                      }
                      
                    
                    });

                    if(myIds.length === salvaNum.length){
                      var valorEl = document.querySelector('.medidas')
                      var valorRecebido = $(".activeInput[data-id='"+ e[1] +"']")

                      var max = valorRecebido[0].dataset.max;
                      var min = valorRecebido[0].dataset.min;
                      var idVariavel = document.getElementById(valorRecebido[0].id)

                      var messagem = document.getElementById('messagem');
                      messagem.style.display = 'none';


                      if(eval(formula) < min ||eval(formula) > max){
                        
                        if(messagem.style.display =='none') {
                          idVariavel.focus();
                          idVariavel.style.borderColor = 'red';
                          messagem.style.display = 'block';
                        }else{
                          messagem.style.display = 'none';
                        }
                        console.log(eval(formula))
                        messagem.innerHTML = '<div><i class="fa-solid fa-triangle-exclamation mr-2"></i> Altere os valores das variáveis. O valor dos cálculos não corresponde ao valor permitido. </div> '
            
                      }else{
                        idVariavel.blur();
                        idVariavel.style.borderColor = '';
                        $(".activeInput[data-id='"+ e[1] +"']").val(eval(formula))
                      }
                      
                    }
                    
                  }
                
                }
              }
            });
          });

          if(allDigitado.indexOf(variavelAtual) > -1 == false ){
            allDigitado.push(variavelAtual)
          }

        }

      }, 900);
    }

    // RELACIONAMENTO PRODUTO COM ETAPA EXIBIR LISTA
    $("#produto").change( function(){
      
      let _token = $('meta[name="_token"]').attr('content');
          $.ajaxSetup({
            headers:
            {
              'X-CSSRF-TOKEN': _token
            }
          });
          let value = $(this).val();

          let url = "{{ route('Painel.Relacionamento.produto') }}";

          $.ajax({
            url: url,
            type: 'post',
            data: {
              value,
              _token: "{{ csrf_token() }}"
            },
            // dataType: 'JSON',
            success: function(data){
              
              $.each(data, function(a, b){
                $("#etapa").append($('<option>',{value:b['id'], text:b['nome_etapa']}));
                $("#etapa_relacionamento").append($('<option>',{value:b['id'], text:b['nome_etapa']}));
              });

            }, 
            error: function(){
            alert("Erro de Comunicação com o Banco de Dados ");
            }
          });

          //etapa
          $("#etapa").empty();
          
          //campo
          $("#campo").empty();
          
          //Grupo
          $("#variaveis").empty();
          // SELECT ETAPA
          $("#etapa").append($('<option>',{value:'', text:'Selecione uma Etapa'}));
          
          
    });

    // RELACIONAMENTO ETAPA COM O CAMPO EXIBIR LISTA
    $("#etapa").change( function(){
      let _token = $('meta[name="_token"]').attr('content');
          $.ajaxSetup({
            headers:
            {
              'X-CSSRF-TOKEN': _token
            }
          });
          let value = $(this).val();
          let url =  "{{route('Painel.Relacionamento.etapa', 'id') }}".replace('id', value);
          $.ajax({
            url: url,
            type: 'post',
            data: {
              value,
              _token: "{{ csrf_token() }}"
            },
            success: function(data){
              // console.log(data)
              $.each(data, function(a, b){
                $("#campo").append($('<option>',{value:b['id'], text:b['name_campo']}))
              })
            }, 
            error: function(){
            alert("Erro de Comunicação com o Banco de Dados ");
            }
          });
          $("#campo").empty();
          $("#campo").append($('<option>',{value:'0', text:'Selecione um Campo'}))
    });

    // RELACIONAMENTO CAMPO COM VARIAVEL EXIBIR LISTA
    $("#campo").change( function(){

      let _token = $('meta[name="_token"]').attr('content');
          $.ajaxSetup({
            headers:
            {
              'X-CSSRF-TOKEN': _token
            }
          });
          let value = $(this).val();
          let url =  "{{route('Painel.Relacionamento.campo', 'id') }}".replace('id', value);
          $.ajax({
            url: url,
            type: 'get',
            data: {
              value,
              _token: "{{ csrf_token() }}"
            },
            // dataType: 'JSON',
            success: function(data){
              $.each(data, function(a, b){
                $("#variaveis").append($('<option>',{value:b['id'], text:b['name_item']}))
              })
            }, 
            error: function(){
            alert("Erro de Comunicação com o Banco de Dados ");
            }
          });
          $("#variaveis").empty();
          $("#variaveis").append($('<option>',{value:'0', text:'Selecione uma variável'}))
          
    });

    var valores = '';
    var formulaRelacionamento = '';
    var novaPrimeira = '';
    var contString = '';

      // RELACIONAMENTO VARIAVEL
    $("#variaveis").change( function(){
      
      var etapa = document.getElementById('etapa');
      var campo = document.getElementById('campo');

      var select_variavel = document.getElementById('variaveis');
      var option = select_variavel.children[select_variavel.selectedIndex];
      var texto_variavel = option.textContent;
      const ipt = document.getElementById('caixaOperadores');

      ipt.value += texto_variavel;
      valores += '['+etapa.value+'-'+campo.value+'-'+option.value+']';

      contString = valores.indexOf('=');
      
      formulaRelacionamento = valores.slice(contString + 1);
      novaPrimeira = valores.slice(0, contString);

    });

      //LIMPAR INPUT COM A FORMULA DE RELACIONAMENTO
    $('#limparRelacionar').on('click', function() {

      var limparOperadores = document.getElementById("caixaOperadores");
      var validate = document.getElementById("validate");

      limparOperadores.value = '';
      valores = '';

      validate.innerHTML = '';
      limparOperadores.style.border = '';

    });

      //SALVAR  A FORMULA DE RELACIONAMENTO
    $('#salvarRelacionamento').on('click', function() {

      var ultimoCaracter = formulaRelacionamento.slice(-1);
      var validarInput = document.getElementById("caixaOperadores");
      validarInput.style.border = '';

      var totalFormula = validarInput.value

      var ch = '=';
      var count = totalFormula.split(ch).length - 1;
      
      if ( contString == -1 || ultimoCaracter == '('  || ultimoCaracter == '' || ultimoCaracter == '=' || ultimoCaracter == '+' || ultimoCaracter == '-'|| ultimoCaracter == '*') {
        
            validarInput.style.border = "2px solid red";

            var text = 'Formula Inválida ou não pode ser vazia'
            var validate = document.getElementById("validate");
            validate.innerHTML = text;
            validate.classList.add("text-danger");

            setTimeout(() => {
              validarInput.style.border = '';
              validate.innerHTML = '';
            }, 8000);


      } else if ( novaPrimeira == formulaRelacionamento ){

        validarInput.style.border = "2px solid red";

        var text = 'Formula Inválida ou não pode ser vazia';
        var validate = document.getElementById("validate");
        validate.innerHTML = text;
        validate.classList.add("text-danger");

        setTimeout(() => {
          validarInput.style.border = '';
          validate.innerHTML = '';
        }, 8000);

      } else if( count > 1){
        validarInput.style.border = "2px solid red";

        var text = 'Formula Inválida ou não pode ser vazia';
        var validate = document.getElementById("validate");
        validate.innerHTML = text;
        validate.classList.add("text-danger");

        setTimeout(() => {
          validarInput.style.border = '';
          validate.innerHTML = '';
        }, 8000);

      }
      else{

        var id_produto = document.getElementById('produto');
        var id_option = id_produto.children[id_produto.selectedIndex];
        var id = id_option.value;

        var nome_formula = document.getElementById('caixaOperadores');
        var valores =  nome_formula.value;
        var arrayValores = valores.split("=")

        validarInput.style.border = "2px solid green"
       
        var formulaFinal = formulaRelacionamento.replace(/\+/gi, 'plus')
                                                .replace(/ - /gi, 'minus')
                                                .replace(/\*/gi, 'times')
                                                .replace(/\(/gi, 'Popen')
                                                .replace(/\)/gi, 'Pclosed')
                                                .replace(/\s+/g, '');

        var dadosRelacionamento = {

          id_do_produto: id_option.value,
          id_associacao: novaPrimeira,
          nome_id_associacao: arrayValores[0],
          formula_associacao: formulaFinal,
          nome_formula_associacao: arrayValores[1]

        };

        let url = "{{ route('Painel.Relacionamento.store'," + id + ") }}"

        $.ajax({
          url: url,
          type: 'post',
          data: {
            dadosRelacionamento,
            _token: "{{ csrf_token() }}"
          },
          // dataType: 'JSON',
          success: function(data){
            
            if(data.error == 0){
              validarInput.style.border = "2px solid green"
              location.reload();

            }else{
              var text = data.text;
              var validate = document.getElementById("validate");
              validate.innerHTML = text;
              validarInput.style.border = "2px solid red"
              validate.classList.add("text-danger");
            }
          }, 
          error: function(){
          alert("Erro de Comunicação com o Banco de Dados ");
          }
        });
      }
      
    });

    //BOTÃO LIMPAR VARIAVEIS
    $("#limpar_variavel").click( function(){
      $("#variaveis").val($("#variaveis option:first").val());
    });

    //BOTOES OPERADOES
    $('#operadoresBtn button').on('click', function() {

      var thisBtn = $(this);
      thisBtn.addClass('active').siblings().removeClass('active');
      var btnText = thisBtn.text();
      var btnValue = thisBtn.val();
      const btnCaixaOperar = document.getElementById('caixaOperadores');

      if(btnCaixaOperar.value === ''){

        var text = 'operador não pode ser o primeiro!'
        var validate = document.getElementById("validate");
        validate.innerHTML = text;
        validate.classList.add("text-danger");

        setTimeout(() => {
          validate.innerHTML = '';
        }, 2000);
          
      }else{

        btnCaixaOperar.value +=' '+ btnValue+' ';
        var validarCalc = btnCaixaOperar.value;
        valores +=' '+btnValue+' ';
        formulaRelacionamento += btnValue;

        if( validarCalc.slice(-1) == '(' ||
            validarCalc.slice(-1) == '=' || 
            validarCalc.slice(-1) == '+' || 
            validarCalc.slice(-1) == '-' ||
            validarCalc.slice(-1) == '*'){

          var text = 'Fomula não é valida! Complete conforme as regras'
          var validate = document.getElementById("validate");
          validate.innerHTML = text;
          validate.classList.add("text-danger");
          setTimeout(() => {
            validate.innerHTML = '';
          }, 5000);

        }
      }
    });

      // SUB-ITEM 
    $(".modal-body #item_subitem").on('change', function(e){

      if($(this).val()== 'semacao'){
        document.getElementById("limite-subitem").style.display = 'none'
        document.getElementById("desconto").style.display = 'none'
        document.getElementById("acrescimo").style.display = 'none'
        document.getElementById("minimo_sub").value = ''
        document.getElementById("maximo_sub").value = ''
        document.getElementById("percent_desconto").value = ''
        document.getElementById("percent_acrescimo").value = ''
      }
      if($(this).val()== 'medidas'){
        document.getElementById("limite-subitem").style.display = 'block'
        document.getElementById("desconto").style.display = 'none'
        document.getElementById("acrescimo").style.display = 'none'
        document.getElementById("percent_desconto").value = ''
        document.getElementById("percent_acrescimo").value = ''
      }
      if($(this).val()== 'desc'){
        document.getElementById("limite-subitem").style.display = 'none'
        document.getElementById("desconto").style.display = 'block'
        document.getElementById("acrescimo").style.display = 'none'
        document.getElementById("minimo_sub").value = ''
        document.getElementById("maximo_sub").value = ''
        document.getElementById("percent_acrescimo").value = ''
      }
      if($(this).val()== 'add'){
        document.getElementById("limite-subitem").style.display = 'none'
        document.getElementById("desconto").style.display = 'none'
        document.getElementById("acrescimo").style.display = 'block'
        document.getElementById("minimo_sub").value = ''
        document.getElementById("maximo_sub").value = ''
        document.getElementById("percent_desconto").value = ''
      }
    });

    // SUB-ITEM EDITAR
    $(".modal-body #item_subitem_edit").on('change', function(e){
      
      if($(this).val()== 'semacao'){
        document.getElementById("limite-subitem_edit").style.display = 'none';
        document.getElementById("desconto_edit").style.display = 'none';
        document.getElementById("acrescimo_edit").style.display = 'none';
        document.getElementById("percent_desconto_edit").value = ''
        document.getElementById("percent_acrescimo_edit").value = ''

      }

      if($(this).val()== 'medidas'){
        
        document.getElementById("limite-subitem_edit").style.display = 'block';
        
        document.getElementById("desconto_edit").style.display = 'none';
        document.getElementById("acrescimo_edit").style.display = 'none';
        document.getElementById("percent_desconto_edit").value = ''
        document.getElementById("percent_acrescimo_edit").value = ''
      }
    
      if($(this).val()== 'desc'){
        document.getElementById("limite-subitem_edit").style.display = 'none';
        document.getElementById("desconto_edit").style.display = 'block';
        document.getElementById("acrescimo_edit").style.display = 'none';
        document.getElementById("percent_acrescimo_edit").value = ''
      }
      if($(this).val()== 'add'){
        document.getElementById("limite-subitem_edit").style.display = 'none';
        document.getElementById("desconto_edit").style.display = 'none';
        document.getElementById("acrescimo_edit").style.display = 'block';
        document.getElementById("percent_desconto_edit").value = ''

      }

    });

    //
    $(".modal-body #limite-subitem").on('change', function(e){
        const min = document.getElementById("minimo_sub")
        const max = document.getElementById("maximo_sub")
        const valor = document.getElementById("calculo")
        valor.value = min.value + '-' + max.value
        valor.setAttribute("name", "acao")
    });

    $(".modal-body #limite-subitem_edit").on('change', function(e){
        const min = document.getElementById("minimo_sub_edit")
        const max = document.getElementById("maximo_sub_edit")
        const valor = document.getElementById("calculo_edit")
        valor.value = min.value + '-' + max.value
        valor.setAttribute("name", "acao")
    });

    $(".modal-body #desconto").on('change', function(e){
      const desconto = document.getElementById("percent_desconto")
      desconto.setAttribute("name", "acao")
    });

    $(".modal-body #desconto_edit").on('change', function(e){
      const desconto = document.getElementById("percent_desconto_edit")
      desconto.setAttribute("name", "acao")
    });

    $(".modal-body #acrescimo_edit").on('change', function(e){
      const acrescimo = document.getElementById("percent_acrescimo_edit")
      acrescimo.setAttribute("name", "acao")
    });

    $('#newsubitem' ).on('show.bs.modal', function(event){
      $(".select2-selection__rendered").text('selecione Ação')
    });

    //Limpa Dados do NOVO SUB ITEM
    $(".modal #sub_itens").on("hidden.bs.modal", function(){

      $(this).find('#sub_itens')[0].reset();
      
      $("#item_subitem option:first").attr('selected','selected')

      document.getElementById("limite-subitem").style.display = 'none';
      document.getElementById("desconto").style.display = 'none';
      document.getElementById("acrescimo").style.display = 'none';
      document.getElementById("exibe_cor").style.display = 'none';
      document.getElementById("exibe_image").style.display = 'none';
    });

    // PEGAR VALORES DO BOTÃO EDITAR ITEM
    $('#editusario').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let nome_user = button.data('myuser')
      let nome_permissao = button.data('myname')
      let user = button.data('myid')
      
      let modal = $(this)
      modal.find('.modal-body #id_user' ).val(user)
      modal.find('.modal-body #user' ).val(nome_user)
      modal.find('.modal-body #permissao').val(nome_permissao).change()
    });

    // PEGAR VALORES DO BOTÃO EDITAR Setor
    $('#editSetor').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let id = button.data('myid')
      let nome_setor = button.data('mysetor')
      
      let modal = $(this)
      modal.find('.modal-body #name_setor' ).val(nome_setor)
      modal.find('.modal-body #id_user' ).val(id)
    });

     // PEGAR VALORES DO BOTÃO RELACIONA SETOR
    $('#relecionar').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let id = button.data('myid')
      let nome_setor = button.data('mysetor')
      let setor_campo = button.data('mysetorcampo')
      let responsaveis = button.data('responsavel')

      let lista_responsavel = []

      if(responsaveis.length > 0){
        lista_responsavel = responsaveis.split(',')
      }else{
        lista_responsavel[0] = responsaveis
      }
      
      let modal = $(this)
      modal.find('.modal-body #relacao_setor' ).val(nome_setor)
      modal.find('.modal-body #id_setor' ).val(id)
      modal.find('.modal-body #responsavel_relacionar').val(lista_responsavel).change()
      
    });

    // PEGAR VALORES DO BOTÃO RELACIONA SETOR
    $('#editar_relecionar').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let id = button.data('myid')
      let nome_setor = button.data('mysetor')
      let setor_campo = button.data('mysetorcampo')
      let campos = button.data('mycampo')
      let responsaveis = button.data('responsavel')

      let lista_campo =[]
      let lista_responsavel = []
      let lista_setor_semId =[]
      let lista_setor_campo
      var teste = []

      setor_campo.forEach((el)=>{
        if(id == el.id_setor){
          lista_campo = el.id_campo.split(',')
          lista_setor_campo = el.id
        }else{
          lista_setor_semId.push(el.id_campo.split(','))
        }
      })
      lista_setor_semIdt = lista_setor_semId.flat()

      if(responsaveis.length > 0){
        lista_responsavel = responsaveis.split(',')
      }else{
        lista_responsavel[0] = responsaveis
      }
      console.log(lista_campo)
      console.log(lista_responsavel)
     
      let modal = $(this)
      modal.find('.modal-body #edit_relacao_setor' ).val(nome_setor)
      modal.find('.modal-body #id_setor_campo' ).val(id)
      modal.find('.modal-body #id_setor_campo_ID' ).val(lista_setor_campo)
      modal.find('.modal-body #edit_setor_campo').val(lista_campo).change()
      modal.find('.modal-body #edit_relacionamento_responsavel').val(lista_responsavel).change()


      for(let i=0; i<lista_campo.length; i++){
        modal.find('.modal-body #edit_setor_campo option[value='+ lista_campo[i] +']').removeAttr('disabled')
      }

      for(let i=0; i<lista_setor_semIdt.length; i++){
        modal.find('.modal-body #edit_setor_campo option[value='+lista_setor_semIdt[i]+']').attr('disabled','disabled')
      }
      
    });

    //DELETAR 

    //Produto
    $('#deleteProduto').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let nome = button.data('myproduto')
      let id = button.data('prodid')
      let deletado = button.data('deletado')
      // console.log(deletado)
      
      let modal = $(this)
      modal.find('.modal-body .valueProduto' ).text( nome)
      modal.find('.modal-body #id_delete' ).val( id)
      modal.find('.modal-body #deletado' ).val(deletado)

    })

    //ETAPA
    $('#deleteEtapa').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let nome = button.data('myetapa')
      let id = button.data('etapaid')
      let deletado = button.data('deletado')

      
      let modal = $(this)
      modal.find('.modal-body .valueEtapa' ).text( nome)
      modal.find('.modal-body #id_delete' ).val( id)
      modal.find('.modal-body #deletado' ).val(deletado)

      

    })
    //ETAPA
    $('#deleteCampo').on('show.bs.modal', function(event){
      let button = $(event.relatedTarget)
      let nome = button.data('mycampo')
      let id = button.data('campoid')
      let deletado = button.data('deletado')

      
      let modal = $(this)
      modal.find('.modal-body .valueCampo' ).text( nome)
      modal.find('.modal-body #id_delete' ).val( id)
      modal.find('.modal-body #deletado' ).val(deletado)

      

    })

</script>
