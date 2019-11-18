package br.com.tjodex.frames;

import java.awt.EventQueue;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import javax.swing.ImageIcon;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;

import br.com.tjodex.dal.ConnectionModule;
import javax.swing.JButton;
import java.awt.Font;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

public class Usuarios extends JFrame {
	
	
	// criando variáveis de apoio 
		Connection con =ConnectionModule.conector();
		PreparedStatement pst = null;
		ResultSet rs = null;

	private JPanel contentPane;
	private JTextField txtId;
	private JTextField txtUsuario;
	private JTextField txtLogin;
	private JTextField txtSenha;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Usuarios frame = new Usuarios();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public Usuarios() {
		setResizable(false);
		setTitle("Usuarios");
		setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		setBounds(100, 100, 570, 400);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JLabel lblId = new JLabel("*id:");
		lblId.setBounds(37, 86, 38, 14);
		contentPane.add(lblId);
		
		txtId = new JTextField();
		txtId.setBounds(79, 83, 148, 20);
		contentPane.add(txtId);
		txtId.setColumns(10);
		
		JLabel lblCamposObrigatorios = new JLabel("*Campos Obrigatorios");
		lblCamposObrigatorios.setFont(new Font("Tahoma", Font.BOLD, 12));
		lblCamposObrigatorios.setBounds(361, 21, 138, 14);
		contentPane.add(lblCamposObrigatorios);
		
		JLabel lblUsuario = new JLabel("*Usuario:");
		lblUsuario.setBounds(15, 136, 60, 14);
		contentPane.add(lblUsuario);
		
		txtUsuario = new JTextField();
		txtUsuario.setBounds(79, 133, 281, 20);
		contentPane.add(txtUsuario);
		txtUsuario.setColumns(10);
		
		JLabel lbllogin = new JLabel("*login:");
		lbllogin.setBounds(27, 185, 48, 14);
		contentPane.add(lbllogin);
		
		txtLogin = new JTextField();
		txtLogin.setBounds(79, 182, 168, 20);
		contentPane.add(txtLogin);
		txtLogin.setColumns(10);
		
		JLabel lblSenha = new JLabel("senha:");
		lblSenha.setBounds(279, 185, 48, 14);
		contentPane.add(lblSenha);
		
		txtSenha = new JTextField();
		txtSenha.setBounds(331, 182, 168, 20);
		contentPane.add(txtSenha);
		txtSenha.setColumns(10);
		
		JButton btnCreate = new JButton("");
		btnCreate.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				create();
			}
		});
		btnCreate.setIcon(new ImageIcon(Usuarios.class.getResource("/br/com/tjodex/icons/create.png")));
		btnCreate.setBounds(79, 238, 64, 64);
		contentPane.add(btnCreate);
		
		JButton btnRead = new JButton("");
		btnRead.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				read();
			}
		});
		btnRead.setIcon(new ImageIcon(Usuarios.class.getResource("/br/com/tjodex/icons/read.png")));
		btnRead.setBounds(203, 238, 64, 64);
		contentPane.add(btnRead);
		
		JButton btnUpdate = new JButton("");
		btnUpdate.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				update();
			}
		});
		btnUpdate.setIcon(new ImageIcon(Usuarios.class.getResource("/br/com/tjodex/icons/update.png")));
		btnUpdate.setBounds(319, 238, 64, 64);
		contentPane.add(btnUpdate);
		
		JButton btnDelete = new JButton("");
		btnDelete.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				delete();
			}
		});
		btnDelete.setIcon(new ImageIcon(Usuarios.class.getResource("/br/com/tjodex/icons/delete.png")));
		btnDelete.setBounds(433, 238, 64, 64);
		contentPane.add(btnDelete);
	}
	
	

	/** CRUD Create **/
	private void create() {
		String create = "insert into tb_usuarios (idUsuario,usuario,loginUsuario, senhaUsuario) values (?,?,?,?)";
		try {
			pst = con.prepareStatement(create);
			//passagem de parâmetros
			pst.setString(1,txtId.getText());
			pst.setString(2,txtUsuario.getText());
			pst.setString(3,txtLogin.getText());
			pst.setString(4, txtSenha.getText());
			int r = pst.executeUpdate();
			if (r > 0) {
				JOptionPane.showMessageDialog(null, "Usuario adicionado com sucesso");
				limpar();
			} else {
				JOptionPane.showMessageDialog(null, "Não foi possivel cadastrar");
			}
		} catch (Exception e) {
			System.out.println(e);
		}
				
	}
	
	
	/** Limpar Campos **/
	private void limpar() {
		txtId.setText(null);
		txtUsuario.setText(null);
		txtLogin.setText(null);
		txtSenha.setText(null);
}
	
	
	/** CRUD READ **/
	private void read() {
		String read = "select * from tb_usuarios where idUsuario = ?";
		//usamos o try catch para tratar exceções
		try {
			pst=con.prepareStatement(read);
			//Passagem do parâmetro
			pst.setString(1, txtId.getText());
			//atribuimos a variavel rs o retorno do comando
			rs = pst.executeQuery();//executar a query(sql)
			//usando o retorno para preencher o JFrame
			if (rs.next()) {
				txtUsuario.setText(rs.getString(2));
				txtLogin.setText(rs.getString(3));
				txtSenha.setText(rs.getString(4));
			} else {
				JOptionPane.showMessageDialog(null, "Usuario inexistente");
				limpar();
			}
		} catch (Exception e) {
			System.out.println(e);
		}
	}
	
	/** CRUD Update **/
	private void update() {
		String update = "update tb_usuarios set usuario=?,loginUsuario=?,senhaUsuario=? where idUsuario =?";
		try {
			pst = con.prepareStatement(update);
			//passagem de parâmetros
			//ATENÇÂO id é o 4 parâmetro
			pst.setString(1,txtUsuario.getText());
			pst.setString(2,txtLogin.getText());
			pst.setString(3,txtSenha.getText());
			pst.setString(4,txtId.getText());
			int r = pst.executeUpdate();
			if (r > 0) {
				JOptionPane.showMessageDialog(null, "Usuario alterado com sucesso");
				limpar();
			} else {
				JOptionPane.showMessageDialog(null, "Não foi possivel alterar o cadastro");
			}
		} catch (Exception e) {
			System.out.println(e);
		}
				
	}
	/** CRUD DELETE **/
	private void delete() {
		//criar uma caixa de dialogo para confirmar a exclusão
		int confirma = JOptionPane.showConfirmDialog(null, "Confirma a exclusão deste Usuario ?", "Atenção",JOptionPane.YES_NO_OPTION);
		if (confirma == JOptionPane.YES_OPTION) {
			String delete = "delete from tb_usuarios where idUsuario=?";
			try {
				pst=con.prepareStatement(delete);
				pst.setString(1,txtId.getText());
				int r = pst.executeUpdate();
				if (r > 0) {
					limpar();
					JOptionPane.showMessageDialog(null, "Usuario removido com sucesso");
				} else {
					JOptionPane.showMessageDialog(null, "Impossivel remover o Usuario");
				}
				
			} catch (Exception e) {
				System.out.println(e);
			}
		}
	}
}