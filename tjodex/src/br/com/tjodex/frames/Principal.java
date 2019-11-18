package br.com.tjodex.frames;

import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JLabel;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;

public class Principal extends JFrame {

	private JPanel contentPane;
	public JButton btnRelatorios;
	public JButton btnUsuarios;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Principal frame = new Principal();
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
	public Principal() {
		setTitle("Principal");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 800, 600);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JButton btnCliente = new JButton("");
		btnCliente.setToolTipText("Cliente");
		btnCliente.setIcon(new ImageIcon(Principal.class.getResource("/br/com/tjodex/icons/cliente.png")));
		btnCliente.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				Clientes cliente = new Clientes();
				cliente.setVisible(true);
				
			}
		});
		btnCliente.setBounds(36, 32, 128, 128);
		contentPane.add(btnCliente);
		
		JButton btnVeiculos = new JButton("");
		btnVeiculos.setToolTipText("Veiculos");
		btnVeiculos.setIcon(new ImageIcon(Principal.class.getResource("/br/com/tjodex/icons/veiculos.png")));
		btnVeiculos.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				Veiculos veiculo = new Veiculos();
				veiculo.setVisible(true);
				
			}
		});
		btnVeiculos.setBounds(36, 171, 128, 128);
		contentPane.add(btnVeiculos);
		
		btnUsuarios = new JButton("");
		btnUsuarios.setEnabled(false);
		btnUsuarios.setToolTipText("Usuarios");
		btnUsuarios.setIcon(new ImageIcon(Principal.class.getResource("/br/com/tjodex/icons/usuarios.png")));
		btnUsuarios.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				Usuarios usuarios = new Usuarios();
				usuarios.setVisible(true);
				
			}
		});
		btnUsuarios.setBounds(203, 171, 128, 128);
		contentPane.add(btnUsuarios);
		
		JButton btnNotaFiscal = new JButton("");
		btnNotaFiscal.setToolTipText("Nota Fiscal");
		btnNotaFiscal.setIcon(new ImageIcon(Principal.class.getResource("/br/com/tjodex/icons/notafiscal.png")));
		btnNotaFiscal.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				NotaFiscal nota = new NotaFiscal();
				nota.setVisible(true);
				
			}
		});
		btnNotaFiscal.setBounds(203, 32, 128, 128);
		contentPane.add(btnNotaFiscal);
		
		btnRelatorios = new JButton("");
		btnRelatorios.setEnabled(false);
		btnRelatorios.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				Reports reports = new Reports();
				reports.setVisible(true);
			}
		});
		btnRelatorios.setToolTipText("Relatorios");
		btnRelatorios.setIcon(new ImageIcon(Principal.class.getResource("/br/com/tjodex/icons/relatorio.png")));
		btnRelatorios.setBounds(36, 310, 128, 128);
		contentPane.add(btnRelatorios);
		
		JButton btnSobre = new JButton("Sobre");
		btnSobre.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				About sobre = new About();
				sobre.setVisible(true);
			}
		});
		btnSobre.setBounds(671, 28, 89, 23);
		contentPane.add(btnSobre);
		
		JLabel lblNewLabel = new JLabel("");
		lblNewLabel.setIcon(new ImageIcon(Principal.class.getResource("/br/com/tjodex/icons/imagemcar.png")));
		lblNewLabel.setBounds(504, 400, 256, 135);
		contentPane.add(lblNewLabel);
	}

}
