import javax.swing.*;
import javax.swing.text.*;
import java.awt.*;
import java.awt.event.*;
import java.text.SimpleDateFormat;
import java.util.Date;
import javax.swing.border.Border;
import javax.swing.ImageIcon;

/**
 * Combined Program:
 * - Main landing page: BusTicketBookingSystem
 * - Book Ticket button opens the busss (College Bus Ticket Generator)
 */
public class CombinedBusApp {
    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            new BusTicketBookingSystem().setVisible(true);
        });
    }
}

// ================== PROGRAM 2 ==================
class BusTicketBookingSystem extends JFrame {

    public BusTicketBookingSystem() {
        setTitle("TOC H Bus Ticket Booking System");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(900, 600);
        setLocationRelativeTo(null);

        // Top navigation bar
        JPanel navBar = new JPanel(new BorderLayout());
        navBar.setBackground(Color.WHITE);
        navBar.setPreferredSize(new Dimension(getWidth(), 80));

        // Load and resize the logo for the home page
        ImageIcon logoIcon = new ImageIcon("logo.png"); // Ensure logo.png is in the project's root folder
        Image image = logoIcon.getImage();
        Image newimg = image.getScaledInstance(60, 60, java.awt.Image.SCALE_SMOOTH);
        logoIcon = new ImageIcon(newimg);

        // Logo/Title (Left)
        JLabel logo = new JLabel("TOC H", logoIcon, JLabel.LEFT);
        logo.setFont(new Font("Arial", Font.BOLD, 32));
        logo.setForeground(new Color(45, 123, 246));
        logo.setBorder(BorderFactory.createEmptyBorder(0, 30, 0, 0));
        logo.setIconTextGap(15); // Adds space between icon and text
        navBar.add(logo, BorderLayout.WEST);

        // Navigation options (Right)
        JPanel navOptions = new JPanel(new FlowLayout(FlowLayout.RIGHT, 25, 25));
        navOptions.setBackground(Color.WHITE);
        
        // Kept only the "About Us" label as requested.
        JLabel aboutUsLabel = new JLabel("About Us");
        aboutUsLabel.setFont(new Font("Arial", Font.PLAIN, 20));
        aboutUsLabel.setForeground(new Color(51, 51, 51));
        navOptions.add(aboutUsLabel);

        navBar.add(navOptions, BorderLayout.EAST);

        // Main section with gradient background
        JPanel mainPanel = new GradientPanel();
        mainPanel.setLayout(null);

        JLabel heading = new JLabel("Bus Ticket Booking Made Easy!");
        heading.setFont(new Font("Arial", Font.BOLD, 36));
        heading.setForeground(Color.WHITE);
        heading.setBounds(60, 80, 700, 50);
        mainPanel.add(heading);

        JLabel subHeading = new JLabel("<html>Book bus tickets, check schedules, and more—all in one place!</html>");
        subHeading.setFont(new Font("Arial", Font.PLAIN, 22));
        subHeading.setForeground(Color.WHITE);
        subHeading.setBounds(60, 150, 650, 40);
        mainPanel.add(subHeading);

        JButton bookBtn = new JButton("Book Ticket");
        bookBtn.setFont(new Font("Arial", Font.BOLD, 22));
        bookBtn.setBackground(new Color(255, 193, 7)); // Yellow
        bookBtn.setForeground(new Color(45, 123, 246));
        bookBtn.setFocusPainted(false);
        bookBtn.setCursor(new Cursor(Cursor.HAND_CURSOR));
        bookBtn.setBorder(new RoundedBorder(30));

        // CHANGED: Increased button width from 180 to 220 to make text visible
        bookBtn.setBounds(60, 220, 220, 55);

        // Open Program 1 (busss)
        bookBtn.addActionListener(e -> {
            new busss().setVisible(true);
        });

        mainPanel.add(bookBtn);

        add(navBar, BorderLayout.NORTH);
        add(mainPanel, BorderLayout.CENTER);
    }

    // Helper class for rounded borders
    static class RoundedBorder implements Border {
        private int radius;
        RoundedBorder(int radius) { this.radius = radius; }
        public Insets getBorderInsets(Component c) { return new Insets(this.radius+1, this.radius+1, this.radius+2, this.radius); }
        public boolean isBorderOpaque() { return false; }
        public void paintBorder(Component c, Graphics g, int x, int y, int width, int height) {
            g.drawRoundRect(x, y, width-1, height-1, radius, radius);
        }
    }

    // Gradient panel for background
    static class GradientPanel extends JPanel {
        @Override
        protected void paintComponent(Graphics g) {
            super.paintComponent(g);
            Graphics2D g2d = (Graphics2D) g;
            Color color1 = new Color(45, 123, 246);
            Color color2 = new Color(53, 106, 255);
            int w = getWidth();
            int h = getHeight();
            GradientPaint gp = new GradientPaint(0, 0, color1, w, h, color2);
            g2d.setPaint(gp);
            g2d.fillRect(0, 0, w, h);
        }
    }
}

// ================== PROGRAM 1 ==================
class busss extends JFrame implements ActionListener {
    // --- UI Colors ---
    private final Color bgColor = new Color(248, 249, 250);
    private final Color primaryColor = new Color(0, 123, 255);
    private final Color secondaryColor = new Color(108, 117, 125);
    private final Color textColor = new Color(33, 37, 41);

    // --- Ticket Colors ---
    private final Color ticketBg = Color.WHITE;
    private final Color ticketHeaderColor = new Color(0, 56, 107);
    private final Color ticketLabelColor = new Color(80, 80, 80);
    private final Color ticketSeparatorColor = new Color(200, 200, 200);

    // --- UI Components ---
    private JTextField tfName, tfDepartment, tfFrom, tfTo, tfDate, tfYear;
    private JComboBox<String> cbCategory;
    private JButton btnGenerate, btnClear;

    public busss() {
        setTitle("College Bus Ticket Generator");
        setSize(550, 680);
        setDefaultCloseOperation(DISPOSE_ON_CLOSE); // Important: only close this window, not app
        setLocationRelativeTo(null);
        setLayout(new BorderLayout());

        JPanel inputPanel = new JPanel(new GridBagLayout());
        inputPanel.setBorder(BorderFactory.createEmptyBorder(30, 30, 30, 30));
        inputPanel.setBackground(bgColor);

        Font labelFont = new Font("Segoe UI", Font.BOLD, 16);
        Font inputFont = new Font("Segoe UI", Font.PLAIN, 16);

        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(10, 10, 10, 10);
        gbc.fill = GridBagConstraints.HORIZONTAL;

        int row = 0;
        addLabelAndField(inputPanel, gbc, row++, "Name:", labelFont, inputFont);
        addLabelAndField(inputPanel, gbc, row++, "Department:", labelFont, inputFont);
        addLabelAndCombo(inputPanel, gbc, row++, "Category:", labelFont, inputFont);
        addLabelAndField(inputPanel, gbc, row++, "Year:", labelFont, inputFont);
        addLabelAndField(inputPanel, gbc, row++, "From:", labelFont, inputFont);
        addLabelAndField(inputPanel, gbc, row++, "To:", labelFont, inputFont);
        addLabelAndField(inputPanel, gbc, row++, "Date (dd-MM-yyyy):", labelFont, inputFont);

        JPanel buttonsPanel = new JPanel(new FlowLayout(FlowLayout.CENTER, 20, 0));
        buttonsPanel.setBackground(bgColor);

        btnGenerate = new JButton("Generate Ticket");
        styleButton(btnGenerate, primaryColor, Color.WHITE);
        btnGenerate.addActionListener(this);

        btnClear = new JButton("Clear");
        styleButton(btnClear, secondaryColor, Color.WHITE);
        btnClear.addActionListener(this);

        buttonsPanel.add(btnGenerate);
        buttonsPanel.add(btnClear);

        gbc.gridx = 0;
        gbc.gridy = row;
        gbc.gridwidth = 2;
        gbc.fill = GridBagConstraints.NONE;
        gbc.anchor = GridBagConstraints.CENTER;
        gbc.insets = new Insets(30, 10, 10, 10);
        inputPanel.add(buttonsPanel, gbc);

        add(inputPanel, BorderLayout.CENTER);

        tfName = (JTextField) inputPanel.getComponent(1);
        tfDepartment = (JTextField) inputPanel.getComponent(3);
        cbCategory = (JComboBox<String>) inputPanel.getComponent(5);
        tfYear = (JTextField) inputPanel.getComponent(7);
        tfFrom = (JTextField) inputPanel.getComponent(9);
        tfTo = (JTextField) inputPanel.getComponent(11);
        tfDate = (JTextField) inputPanel.getComponent(13);
        tfDate.setText(new SimpleDateFormat("dd-MM-yyyy").format(new Date()));
    }

    private void addLabelAndField(JPanel panel, GridBagConstraints gbc, int row, String labelText, Font labelFont, Font inputFont) {
        gbc.gridx = 0;
        gbc.gridy = row;
        gbc.weightx = 0.3;
        JLabel label = new JLabel(labelText);
        label.setFont(labelFont);
        label.setForeground(textColor);
        panel.add(label, gbc);

        gbc.gridx = 1;
        gbc.weightx = 0.7;
        JTextField textField = new JTextField();
        textField.setFont(inputFont);
        textField.setBackground(Color.WHITE);
        textField.setForeground(textColor);
        textField.setPreferredSize(new Dimension(250, 40));
        textField.setBorder(BorderFactory.createCompoundBorder(
                BorderFactory.createLineBorder(new Color(206, 212, 218)),
                BorderFactory.createEmptyBorder(5, 10, 5, 10)));
        panel.add(textField, gbc);
    }

    private void addLabelAndCombo(JPanel panel, GridBagConstraints gbc, int row, String labelText, Font labelFont, Font inputFont) {
        gbc.gridx = 0;
        gbc.gridy = row;
        JLabel label = new JLabel(labelText);
        label.setFont(labelFont);
        label.setForeground(textColor);
        panel.add(label, gbc);

        gbc.gridx = 1;
        JComboBox<String> comboBox = new JComboBox<>(new String[]{"Student", "Teacher", "Other"});
        comboBox.setFont(inputFont);
        comboBox.setBackground(Color.WHITE);
        comboBox.setForeground(textColor);
        comboBox.setPreferredSize(new Dimension(250, 40));
        panel.add(comboBox, gbc);
    }

    private void styleButton(JButton button, Color bgColor, Color fgColor) {
        button.setFont(new Font("Segoe UI", Font.BOLD, 16));
        button.setBackground(bgColor);
        button.setForeground(fgColor);
        button.setFocusPainted(false);
        button.setBorder(BorderFactory.createEmptyBorder(12, 25, 12, 25));
        button.setCursor(new Cursor(Cursor.HAND_CURSOR));
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if (e.getSource() == btnGenerate) {
            generateTicketInNewWindow();
        } else if (e.getSource() == btnClear) {
            clearFields();
        }
    }

    private void generateTicketInNewWindow() {
        String name = tfName.getText().trim();
        String department = tfDepartment.getText().trim();
        String category = (String) cbCategory.getSelectedItem();
        String year = tfYear.getText().trim();
        String from = tfFrom.getText().trim();
        String to = tfTo.getText().trim();
        String date = tfDate.getText().trim();

        if (name.isEmpty() || department.isEmpty() || year.isEmpty() || from.isEmpty() || to.isEmpty() || date.isEmpty()) {
            JOptionPane.showMessageDialog(this, "Please fill all fields.", "Error", JOptionPane.ERROR_MESSAGE);
            return;
        }
        if (!isValidDate(date)) {
            JOptionPane.showMessageDialog(this, "Please enter a valid date in dd-MM-yyyy format.", "Error", JOptionPane.ERROR_MESSAGE);
            return;
        }

        String busNumber = "...";
        String amount = "...";

        JFrame ticketFrame = new JFrame("Generated Ticket");
        ticketFrame.setSize(480, 600);
        ticketFrame.setLocationRelativeTo(this);
        ticketFrame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);

        JTextPane ticketPane = new JTextPane();
        ticketPane.setEditable(false);
        ticketPane.setBackground(ticketBg);
        ticketPane.setMargin(new Insets(25, 25, 25, 25));

        StyledDocument doc = ticketPane.getStyledDocument();
        addStylesToDocument(doc);

        try {
            // Load, resize, and add logo to the ticket
            ImageIcon ticketLogoIcon = new ImageIcon("logo.png"); // Ensure logo.png is in the project's root folder
            Image image = ticketLogoIcon.getImage();
            Image newimg = image.getScaledInstance(80, 80, java.awt.Image.SCALE_SMOOTH);
            ticketLogoIcon = new ImageIcon(newimg);

            Style centerStyle = doc.addStyle("center", null);
            StyleConstants.setAlignment(centerStyle, StyleConstants.ALIGN_CENTER);
            
            doc.setParagraphAttributes(doc.getLength(), 1, centerStyle, false);
            ticketPane.setCaretPosition(doc.getLength());
            ticketPane.insertIcon(ticketLogoIcon);

            // ADDED: Name "TOC H" under the logo
            addStyledText(doc, "\nTOC H\n", doc.getStyle("orgName"));

            String separator = "────────────────────────────────────────\n";
            addStyledText(doc, "\nCOLLEGE BUS TICKET\n", doc.getStyle("title"));
            addStyledText(doc, separator, doc.getStyle("separator"));
            addStyledText(doc, "Name         : ", doc.getStyle("label"));
            addStyledText(doc, name + "\n", doc.getStyle("data"));
            addStyledText(doc, "Department   : ", doc.getStyle("label"));
            addStyledText(doc, department + "\n", doc.getStyle("data"));
            addStyledText(doc, "Category     : ", doc.getStyle("label"));
            addStyledText(doc, category + "\n", doc.getStyle("data"));
            addStyledText(doc, "Year         : ", doc.getStyle("label"));
            addStyledText(doc, year + "\n", doc.getStyle("data"));
            addStyledText(doc, "\n", doc.getStyle("data"));
            addStyledText(doc, "Bus Number   : ", doc.getStyle("label"));
            addStyledText(doc, busNumber + "\n", doc.getStyle("dataBold"));
            addStyledText(doc, "From         : ", doc.getStyle("label"));
            addStyledText(doc, from + "\n", doc.getStyle("data"));
            addStyledText(doc, "To           : ", doc.getStyle("label"));
            addStyledText(doc, to + "\n", doc.getStyle("data"));
            addStyledText(doc, "Date         : ", doc.getStyle("label"));
            addStyledText(doc, date + "\n", doc.getStyle("data"));
            addStyledText(doc, "Amount (₹)   : ", doc.getStyle("label"));
            addStyledText(doc, amount + "\n", doc.getStyle("dataBold"));
            addStyledText(doc, separator, doc.getStyle("separator"));
            addStyledText(doc, "Have a safe and pleasant trip!\n", doc.getStyle("footer"));
            addStyledText(doc, separator, doc.getStyle("separator"));
        } catch (BadLocationException ex) {
            ex.printStackTrace();
        }

        ticketFrame.add(new JScrollPane(ticketPane));
        ticketFrame.setVisible(true);
    }

    private void addStylesToDocument(StyledDocument doc) {
        Style title = doc.addStyle("title", null);
        StyleConstants.setFontFamily(title, "Segoe UI");
        StyleConstants.setBold(title, true);
        StyleConstants.setFontSize(title, 28);
        StyleConstants.setForeground(title, ticketHeaderColor);
        StyleConstants.setAlignment(title, StyleConstants.ALIGN_CENTER);
        StyleConstants.setSpaceBelow(title, 15);

        // ADDED: Style for the "TOC H" name under the logo
        Style orgName = doc.addStyle("orgName", title);
        StyleConstants.setFontSize(orgName, 20);

        Style separator = doc.addStyle("separator", null);
        StyleConstants.setForeground(separator, ticketSeparatorColor);
        StyleConstants.setAlignment(separator, StyleConstants.ALIGN_CENTER);
        StyleConstants.setBold(separator, true);

        Style label = doc.addStyle("label", null);
        StyleConstants.setFontFamily(label, "Consolas");
        StyleConstants.setFontSize(label, 16);
        StyleConstants.setForeground(label, ticketLabelColor);

        Style data = doc.addStyle("data", label);
        StyleConstants.setForeground(data, textColor);

        Style dataBold = doc.addStyle("dataBold", data);
        StyleConstants.setBold(dataBold, true);
        StyleConstants.setForeground(dataBold, ticketHeaderColor);

        Style footer = doc.addStyle("footer", separator);
        StyleConstants.setItalic(footer, true);
        StyleConstants.setFontSize(footer, 14);
        StyleConstants.setForeground(footer, ticketLabelColor);
    }

    private void addStyledText(StyledDocument doc, String text, Style style) throws BadLocationException {
        int start = doc.getLength();
        doc.insertString(start, text, style);
        doc.setParagraphAttributes(start, text.length(), style, false);
    }

    private void clearFields() {
        tfName.setText("");
        tfDepartment.setText("");
        cbCategory.setSelectedIndex(0);
        tfYear.setText("");
        tfFrom.setText("");
        tfTo.setText("");
        tfDate.setText(new SimpleDateFormat("dd-MM-yyyy").format(new Date()));
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
}