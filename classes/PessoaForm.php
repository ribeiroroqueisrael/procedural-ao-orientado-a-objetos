<?php
require_once 'Pessoa.php';
require_once 'Cidade.php';

class PessoaForm
{
    private $html;
    private $data;

    public function __construct()
    {
        $this->html = file_get_contents('html/form.html');
        $this->data = [
            'id' => '', 'nome' => '', 'email' => '', 'telefone' => '',
            'endereco' => '', 'bairro' => '', 'fk_id_cidade' => ''
        ];
    }

    public function edit($params)
    {
        try {
            $id = (int) $params['id'];
            $this->data = Pessoa::findById($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function save($params)
    {
        try {
            Pessoa::save($params);
            $this->data = $params;
            print 'Dados salvos com sucesso!';
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function show()
    {
        $this->html = str_replace("{id}", $this->data['id'], $this->html);
        $this->html = str_replace("{nome}", $this->data['nome'], $this->html);
        $this->html = str_replace("{email}", $this->data['email'], $this->html);
        $this->html = str_replace("{telefone}", $this->data['telefone'], $this->html);
        $this->html = str_replace("{endereco}", $this->data['endereco'], $this->html);
        $this->html = str_replace("{bairro}", $this->data['bairro'], $this->html);
        $this->html = str_replace("{fk_id_cidade}", $this->data['fk_id_cidade'], $this->html);

        $cidades = '';
        foreach (Cidade::listAll() as $cidade) {
            $cidades .= "<option value='{$cidade['id']}'>{$cidade['nome']}</option>";
        }
        $this->html = str_replace('{cidades}', $cidades, $this->html);

        $this->html = str_replace(
            "<option value='{$this->data['fk_id_cidade']}'>",
            "<option value='{$this->data['fk_id_cidade']}' selected>",
            $this->html
        );
        print $this->html;
    }
}
