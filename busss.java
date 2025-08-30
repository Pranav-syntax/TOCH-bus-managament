import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.text.SimpleDateFormat;
import java.util.Date;

public class busss extends JFrame implements ActionListener {
    // Components
    private JTextField tfName, tfBusNo, tfSource, tfDestination, tfDate, tfAmount;
    private JButton btnGenerate, btnClear;
    private JTextArea taTicket;

    public busss() {
        setTitle("College Bus Ticket Generator");
        setSize(500, 650);
        setDefaultCloseOperation(EXIT_ON_CLOSE);
        setLocationRelativeTo(null);
        setLayout(new BorderLayout());

        // Panel for input fields
        JPanel inputPanel = new JPanel();
        inputPanel.setLayout(new GridLayout(7, 2, 10, 10));
        inputPanel.setBorder(BorderFactory.createEmptyBorder(20, 20, 20, 20));

        inputPanel.add(new JLabel("Name:"));
        tfName = new JTextField();
        inputPanel.add(tfName);

        inputPanel.add(new JLabel("Bus Number:"));
        tfBusNo = new JTextField();
        inputPanel.add(tfBusNo);

        inputPanel.add(new JLabel("From:"));
        tfSource = new JTextField("Toc H Institute of Science & Technology");
        inputPanel.add(tfSource);

        inputPanel.add(new JLabel("To:"));
        tfDestination = new JTextField();
        inputPanel.add(tfDestination);

        inputPanel.add(new JLabel("Date (dd-MM-yyyy):"));
        tfDate = new JTextField(new SimpleDateFormat("dd-MM-yyyy").format(new Date()));
        inputPanel.add(tfDate);

        inputPanel.add(new JLabel("Amount (₹):"));
        tfAmount = new JTextField();
        inputPanel.add(tfAmount);

        btnGenerate = new JButton("Generate Ticket");
        btnGenerate.addActionListener(this);

        btnClear = new JButton("Clear");
        btnClear.addActionListener(this);

        inputPanel.add(btnGenerate);
        inputPanel.add(btnClear);

        add(inputPanel, BorderLayout.NORTH);

        // Text area for ticket display
        taTicket = new JTextArea();
        taTicket.setFont(new Font("Monospaced", Font.PLAIN, 14));
        taTicket.setEditable(false);
        taTicket.setMargin(new Insets(10, 10, 10, 10));
        JScrollPane scrollPane = new JScrollPane(taTicket);
        add(scrollPane, BorderLayout.CENTER);
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == btnGenerate) {
            generateTicket();
        } else if (e.getSource() == btnClear) {
            clearFields();
        }
    }

    private void generateTicket() {
        String name = tfName.getText().trim();
        String busNo = tfBusNo.getText().trim();
        String source = tfSource.getText().trim();
        String destination = tfDestination.getText().trim();
        String date = tfDate.getText().trim();
        String amountStr = tfAmount.getText().trim();

        if (name.isEmpty() || busNo.isEmpty() || source.isEmpty() || destination.isEmpty() || date.isEmpty() || amountStr.isEmpty()) {
            JOptionPane.showMessageDialog(this, "Please fill all fields.", "Error", JOptionPane.ERROR_MESSAGE);
            return;
        }

        // Validate date format
        if (!isValidDate(date)) {
            JOptionPane.showMessageDialog(this, "Please enter date in dd-MM-yyyy format.", "Error", JOptionPane.ERROR_MESSAGE);
            return;
        }

        // Validate amount is a positive number
        double amount;
        try {
            amount = Double.parseDouble(amountStr);
            if (amount < 0) throw new NumberFormatException();
        } catch (NumberFormatException ex) {
            JOptionPane.showMessageDialog(this, "Please enter a valid positive number for amount.", "Error", JOptionPane.ERROR_MESSAGE);
            return;
        }

        // Generate ticket text
        StringBuilder ticket = new StringBuilder();
        ticket.append("====================================\n");
        ticket.append("         COLLEGE BUS TICKET         \n");
        ticket.append("====================================\n");
        ticket.append(String.format("Name          : %s\n", name));
        ticket.append(String.format("Bus Number    : %s\n", busNo));
        ticket.append(String.format("From        : %s\n", source));
        ticket.append(String.format("To   : %s\n", destination));
        ticket.append(String.format("Date          : %s\n", date));
        ticket.append(String.format("Amount (₹)    : %.2f\n", amount));
        ticket.append("====================================\n");
        ticket.append("      Have a safe and pleasant trip!\n");
        ticket.append("====================================\n");

        taTicket.setText(ticket.toString());
    }

    private void clearFields() {
        tfName.setText("");
        tfBusNo.setText("");
        tfSource.setText("Toc H Institute of Science & Technology");
        tfDestination.setText("");
        tfDate.setText(new SimpleDateFormat("dd-MM-yyyy").format(new Date()));
        tfAmount.setText("");
        taTicket.setText("");
    }

    private boolean isValidDate(String dateStr) {
        try {
            SimpleDateFormat sdf = new SimpleDateFormat("dd-MM-yyyy");
            sdf.setLenient(false);
            sdf.parse(dateStr);
            return true;
        } catch (Exception ex) {
            return false;
        }
    }

    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            new busss().setVisible(true);
        });
    }
}